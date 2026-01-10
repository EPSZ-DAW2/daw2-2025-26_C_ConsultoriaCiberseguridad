<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Servicio;
use common\models\SolicitudesPresupuesto;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'usuarios', 'create-user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $loginResult = false;
        
        if ($model->load(Yii::$app->request->post())) {
            $loginResult = $model->login();
            
            if ($loginResult === '2fa_required') {
                return $this->redirect(['site/login-totp']);
            }
            
            if ($loginResult === true) {
                // Redirigir según el tipo de usuario
                if (Yii::$app->user->identity->isBackendUser()) {
                    $backendUrl = str_replace('/frontend/web', '/backend/web', Yii::$app->request->baseUrl);
                    return $this->redirect($backendUrl . '/index.php?r=site/index');
                } else {
                    return $this->goHome();
                }
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Paso 2 del login: Verificación TOTP
     */
    public function actionLoginTotp()
    {
        // Si no hay ID de usuario pendiente en sesión, volver al login normal
        if (!Yii::$app->session->has('2fa_user_id')) {
            return $this->redirect(['site/login']);
        }

        if (Yii::$app->request->isPost) {
            $code = Yii::$app->request->post('totp_code');
            $userId = Yii::$app->session->get('2fa_user_id');
            $rememberMe = Yii::$app->session->get('2fa_remember_me');

            $user = \common\models\User::findOne($userId);
            
            if ($user && $user->verifyTotp($code)) {
                // Login Exitoso
                Yii::$app->user->login($user, $rememberMe ? 3600 * 24 * 30 : 0);
                
                // Limpiar sesión temporal
                Yii::$app->session->remove('2fa_user_id');
                Yii::$app->session->remove('2fa_remember_me');

                return $this->goBack();
            } else {
                Yii::$app->session->setFlash('error', 'Código de verificación incorrecto.');
            }
        }

        return $this->render('login-totp');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            // Guardar en Base de Datos
            $solicitud = new \common\models\SolicitudesPresupuesto();
            $solicitud->nombre_contacto = $model->nombre . ' ' . $model->apellidos;
            $solicitud->email_contacto = $model->email;
            $solicitud->empresa = 'No especificada (Contacto Web)'; 
            $solicitud->descripcion_necesidad = $model->mensaje;
            $solicitud->origen_solicitud = 'Web';
            $solicitud->fecha_solicitud = date('Y-m-d H:i:s');
            $solicitud->estado_solicitud = 'Pendiente';
            $solicitud->prioridad = 2; // Media

            if ($solicitud->save()) {
                Yii::$app->session->setFlash('success', 'Mensaje enviado y registrado correctamente. Nos pondremos en contacto pronto.');
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un error al guardar tu mensaje.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
        'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionCatalogo()
    {
        $servicios = \common\models\Servicios::find()
            ->where(['activo' => 1])
            ->all();

        return $this->render('catalogo', [
            'servicios' => $servicios,
        ]);
    }

    public function actionPoliticaPrivacidad()
    {
        // Esto busca el archivo en views/site/politica-privacidad.php
        return $this->render('politica-privacidad');
    }

    /**
     * Muestra la página de Términos y Condiciones
     */
    public function actionTerminos()
    {
        // Esto busca el archivo en views/site/terminos.php
        return $this->render('terminos');
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * Muestra la página de detalle de un servicio.
     * @param int $id
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionServicio($id)
    {
        $servicio = \common\models\Servicios::findOne(['id' => $id, 'activo' => 1]);

        if (!$servicio) {
            throw new \yii\web\NotFoundHttpException('El servicio solicitado no existe o no está activo.');
        }

        return $this->render('servicio', [
            'servicio' => $servicio,
        ]);
    }

    public function actionConfiguracion()
    {
        $user = Yii::$app->user->identity;
        $secret = null;
        $qrCodeUrl = null;

        if (!$user->totp_activo) {
            $google2fa = $user->getGoogle2fa();
            
            // Generar o recuperar secreto temporal de la sesión
            if (!Yii::$app->session->has('2fa_setup_secret')) {
                Yii::$app->session->set('2fa_setup_secret', $google2fa->generateSecretKey());
            }
            $secret = Yii::$app->session->get('2fa_setup_secret');

            // Generar URL para el QR
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                Yii::$app->name,
                $user->email,
                $secret
            );
        } else {
            // Si ya está activo, limpiamos cualquier secreto temporal porsiaca
            Yii::$app->session->remove('2fa_setup_secret');
        }

        return $this->render('configuracion', [
            'secret' => $secret,
            'qrCodeUrl' => $qrCodeUrl
        ]);
    }

    public function actionSolicitarPresupuesto($servicio_id)
    {
        // 1. Usuario debe estar logueado
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        // 2. Crear solicitud
        $solicitud = new SolicitudesPresupuesto();
        $solicitud->servicio_id = $servicio_id;

        // Datos mínimos
        $user = Yii::$app->user->identity;
        $solicitud->nombre_contacto = trim($user->nombre . ' ' . ($user->apellidos ?? ''));
        $solicitud->email_contacto = $user->email;
        $solicitud->empresa = 'Cliente Web';
        $solicitud->descripcion_necesidad = 'Solicitud iniciada desde el catálogo de servicios';
        $solicitud->estado_solicitud = SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE;
        $solicitud->origen_solicitud = 'Web';

        if ($solicitud->save()) {
            Yii::$app->session->setFlash(
                'success',
                'Solicitud enviada correctamente. Nuestro equipo se pondrá en contacto contigo.'
            );
        } else {
            Yii::$app->session->setFlash(
                'error',
                'No se pudo enviar la solicitud.'
            );
        }

        return $this->redirect(['site/catalogo']);
    }
    public function actionChangePassword()
    {
        // Solo usuarios logueados
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $request = Yii::$app->request;
        if ($request->isPost) {
            $email = $request->post('email');
            $currentPassword = $request->post('current_password');
            $newPassword = $request->post('new_password');

            $user = Yii::$app->user->identity;

            // 1. Validar Email
            if (!$user || $user->email !== $email) {
                Yii::$app->session->setFlash('error', 'El email introducido no coincide con tu cuenta.');
                return $this->redirect(['site/configuracion']);
            }

            // 2. Validar Contraseña Actual
            if (!$user->validatePassword($currentPassword)) {
                Yii::$app->session->setFlash('error', 'La contraseña actual es incorrecta.');
                return $this->redirect(['site/configuracion']);
            }

            // 3. Cambiar Contraseña
            if (!empty($newPassword)) {
                $user->setPassword($newPassword);
                // Si la tabla usa auth_key, es buena práctica regenerarla al cambiar password
                $user->generateAuthKey(); 
                
                if ($user->save()) {
                    // Re-login para actualizar la sesión con la nueva auth_key y evitar desconexión
                    Yii::$app->user->login($user);
                    Yii::$app->session->setFlash('success', 'Contraseña actualizada correctamente.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar la nueva contraseña.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'La nueva contraseña no puede estar vacía.');
            }
        }

        return $this->redirect(['site/configuracion']);
    }

    public function actionUpdateProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $request = Yii::$app->request;
        if ($request->isPost) {
            $user = Yii::$app->user->identity;

            // Datos de seguridad para autorizar cambios
            $authEmail = $request->post('auth_email');
            $authPassword = $request->post('auth_password');

            // 1. Validar Email
            if (!$user || $user->email !== $authEmail) {
                Yii::$app->session->setFlash('error', 'El email de confirmación no coincide con tu cuenta.');
                return $this->redirect(['site/configuracion']);
            }

            // 2. Validar Contraseña
            if (!$user->validatePassword($authPassword)) {
                Yii::$app->session->setFlash('error', 'La contraseña introducida es incorrecta. No se han guardado los cambios.');
                return $this->redirect(['site/configuracion']);
            }

            // 3. Actualizar Datos
            $user->nombre = $request->post('nombre');
            $user->apellidos = $request->post('apellidos');
            // Email NO se actualiza aquí
            
            $user->empresa = $request->post('empresa');
            $user->telefono = $request->post('telefono');
            $user->direccion = $request->post('direccion');

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Perfil actualizado correctamente.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al guardar los datos del perfil.');
            }
        }
        return $this->redirect(['site/configuracion']);
    }

    public function actionUpdateRecoveryEmail()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $request = Yii::$app->request;
        if ($request->isPost) {
            $user = Yii::$app->user->identity;
            $password = $request->post('password_confirm');
            $recoveryEmail = $request->post('email_recuperacion');

            // 1. Validar Contraseña
            if (!$user->validatePassword($password)) {
                Yii::$app->session->setFlash('error', 'Contraseña incorrecta. No se ha guardado el correo de recuperación.');
                return $this->redirect(['site/configuracion']);
            }

            // 2. Validar y Guardar Email
            $user->email_recuperacion = $recoveryEmail;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Correo de recuperación actualizado.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al guardar el correo. Verifica el formato.');
            }
        }
        return $this->redirect(['site/configuracion']);
    }

    /**
     * Activa el 2FA verificando el código
     */
    public function actionEnableTotp()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->request->isPost) {
            return $this->redirect(['site/login']);
        }

        $code = Yii::$app->request->post('totp_code');
        $secret = Yii::$app->request->post('totp_secret'); // Secreto temporal enviado desde form
        $user = Yii::$app->user->identity;

        // Verificar validez del código con el secreto temporal
        if ($user->verifyTotp($code, $secret)) {
            $user->totp_secret = $secret;
            $user->totp_activo = 1;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Autenticación en dos pasos activada correctamente.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al guardar configuración 2FA.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Código de verificación incorrecto.');
        }

        return $this->redirect(['site/configuracion']);
    }

    /**
     * Desactiva el 2FA
     */
    public function actionDisableTotp()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->request->isPost) {
            return $this->redirect(['site/login']);
        }
        
        $password = Yii::$app->request->post('current_password');
        $user = Yii::$app->user->identity;

        if ($user->validatePassword($password)) {
            $user->totp_secret = null;
            $user->totp_activo = 0;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Autenticación en dos pasos desactivada.');
            }
        } else {
           Yii::$app->session->setFlash('error', 'Contraseña incorrecta, no se pudo desactivar 2FA.'); 
        }

        return $this->redirect(['site/configuracion']);
    }

    /**
     * Genera y descarga una factura en PDF
     * @param int $id ID de la solicitud
     */
    public function actionDescargarFactura($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $user = Yii::$app->user->identity;
        // Buscar la solicitud y verificar propiedad
        $solicitud = \common\models\SolicitudesPresupuesto::findOne($id);

        if (!$solicitud) {
            throw new \yii\web\NotFoundHttpException('La solicitud no existe.');
        }

        // Verificar permisos: dueño o admin
        if ($solicitud->email_contacto !== $user->email && !$user->isBackendUser()) {
            throw new \yii\web\ForbiddenHttpException('No tienes permiso para ver esta factura.');
        }

        // Renderizar vista a HTML
        $content = $this->renderPartial('invoice', [
            'model' => $solicitud,
            'solicitud' => $solicitud
        ]);

        // Configurar Mpdf
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($content);
        
        // Nombre del archivo
        $filename = 'Factura_' . date('Y') . '-' . str_pad($solicitud->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        // Descargar
        return $pdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
    }

    /**
     * Genera y descarga un presupuesto en PDF
     * @param int $id ID de la solicitud
     */
    public function actionDescargarPresupuesto($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $user = Yii::$app->user->identity;
        $solicitud = \common\models\SolicitudesPresupuesto::findOne($id);

        if (!$solicitud) {
            throw new \yii\web\NotFoundHttpException('La solicitud no existe.');
        }

        // Verificar permisos: dueño o admin
        if ($solicitud->email_contacto !== $user->email && !$user->isBackendUser()) {
            throw new \yii\web\ForbiddenHttpException('No tienes permiso para ver este presupuesto.');
        }

        // Renderizar vista a HTML
        $content = $this->renderPartial('budget', [
            'model' => $solicitud,
            'solicitud' => $solicitud
        ]);

        // Configurar Mpdf
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($content);
        
        // Nombre del archivo
        $filename = 'Presupuesto_' . date('Y') . '-' . str_pad($solicitud->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        // Descargar
        return $pdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
    }
    /**
     * Gestión de usuarios para Cliente Admin
     */
    public function actionUsuarios()
    {
        $user = Yii::$app->user->identity;
        // Solo cliente_admin puede acceder
        if ($user->rol !== \common\models\User::ROL_CLIENTE_ADMIN) {
           throw new \yii\web\ForbiddenHttpException('No tienes permiso para gestionar usuarios.');
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\User::find()
                ->where(['empresa' => $user->empresa])
                ->andWhere(['!=', 'id', $user->id]), // No mostrarse a sí mismo
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('usuarios', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateUser()
    {
        $currentUser = Yii::$app->user->identity;
        if ($currentUser->rol !== \common\models\User::ROL_CLIENTE_ADMIN) {
           throw new \yii\web\ForbiddenHttpException('No tienes permiso.');
        }

        $model = new \frontend\models\SignupForm(); // Reutilizamos SignupForm o creamos uno simple
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Forzamos datos empresariales
            $user = new \common\models\User();
            // $user->username = $model->email; // ERROR: Property is read-only
            $user->email = $model->email;
            $user->nombre = $model->username; // En SignupForm username es nombre
            $user->setPassword($model->password);
            $user->generateAuthKey();
            $user->rol = \common\models\User::ROL_CLIENTE_USER;
            $user->empresa = $currentUser->empresa;
            $user->activo = 1;
            $user->fecha_registro = date('Y-m-d H:i:s');
            
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Empleado creado correctamente.');
                return $this->redirect(['usuarios']);
            } else {
                Yii::$app->session->setFlash('error', 'Error al crear usuario: ' . json_encode($user->errors));
            }
        }

        return $this->render('create_user', ['model' => $model]);
    }
}
