<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username; // Esto será el "Nombre"
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // REGLAS PARA EL NOMBRE (antes username)
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Por favor, escribe tu nombre.'],
            // ELIMINADA LA REGLA 'UNIQUE' PARA USERNAME PORQUE TU TABLA NO TIENE COLUMNA 'USERNAME'
            ['username', 'string', 'min' => 2, 'max' => 255],

            // REGLAS PARA EL EMAIL
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            // Esta regla comprueba que el email no exista ya en la tabla 'User' (usuarios)
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya está registrado.'],

            // REGLAS PARA LA CONTRASEÑA
            ['password', 'required'],
            ['password', 'string', 'min' => 8], // He puesto mínimo 8 por seguridad
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and the email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        
        // ASIGNACIÓN DE DATOS (Formulario -> Base de Datos)
        $user->nombre = $this->username; // Guardamos lo que escriban en 'Username' dentro de 'nombre'
        $user->email = $this->email;
        $user->activo = User::STATUS_INACTIVE; // Inactivo hasta verificar
        $user->fecha_registro = date('Y-m-d H:i:s'); // Fecha actual
        
        // IMPORTANTE: Si tu base de datos obliga a tener 'apellidos', 
        // pon una cadena vacía o añade el campo al formulario.
        // $user->apellidos = ''; 
        
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        
        // Guardar usuario
        if ($user->save()) {
            // Asignar rol por defecto (Cliente) si existe el sistema RBAC
            $auth = Yii::$app->authManager;
            $clienteRole = $auth->getRole('cliente'); 
            if ($clienteRole) {
                $auth->assign($clienteRole, $user->id);
            }
            
            // Enviar correo
            return $this->sendEmail($user);
        }

        return null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'Equipo Técnico de CyberSec'])
            ->setTo($this->email)
            ->setSubject('Registro de cuenta en ' . Yii::$app->name)
            ->send();
    }
}