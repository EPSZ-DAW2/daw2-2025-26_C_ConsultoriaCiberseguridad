<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    // COMANDO 1: php yii rbac/init (Este ya lo ejecutaste)
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); 

        echo "Creando permisos...\n";

        // --- PERMISOS ---
        $verPanel = $auth->createPermission('verPanel');
        $verPanel->description = 'Entrar al panel de administración';
        $auth->add($verPanel);

        $verMisProyectos = $auth->createPermission('verMisProyectos');
        $verMisProyectos->description = 'Ver Mis Proyectos y Formación';
        $auth->add($verMisProyectos);

        $gestionarProyectos = $auth->createPermission('gestionarProyectos');
        $gestionarProyectos->description = 'Crear proyectos y gestionar';
        $auth->add($gestionarProyectos);
        
        $subirDocs = $auth->createPermission('subirDocs');
        $subirDocs->description = 'Subir documentación';
        $auth->add($subirDocs);

        $verDocs = $auth->createPermission('verDocs');
        $verDocs->description = 'Ver documentación sin borrar';
        $auth->add($verDocs);

        $escribirCalendario = $auth->createPermission('escribirCalendario');
        $escribirCalendario->description = 'Permiso exclusivo calendario';
        $auth->add($escribirCalendario);

        echo "Asignando jerarquias...\n";

        // --- ROLES ---
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $verMisProyectos);

        $consultor = $auth->createRole('consultor');
        $auth->add($consultor);
        $auth->addChild($consultor, $verPanel);
        $auth->addChild($consultor, $gestionarProyectos);
        $auth->addChild($consultor, $subirDocs);
        $auth->addChild($consultor, $verDocs);

        $auditor = $auth->createRole('auditor');
        $auth->add($auditor);
        $auth->addChild($auditor, $verPanel);
        $auth->addChild($auditor, $verDocs);
        $auth->addChild($auditor, $escribirCalendario);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $consultor);
        $auth->addChild($admin, $auditor);
        $auth->addChild($admin, $cliente);

        echo "¡Roles creados con éxito! :)\n";
    }

    // COMANDO 2: php yii rbac/assign <rol> <id_usuario> (ESTE ES EL NUEVO)
    public function actionAssign($role, $id)
    {
        $auth = Yii::$app->authManager;
        $roleObject = $auth->getRole($role);

        if (!$roleObject) {
            echo "Error: El rol '{$role}' no existe.\n";
            return;
        }

        try {
            $auth->assign($roleObject, $id);
            echo "¡Éxito! Rol '{$role}' asignado al usuario {$id}.\n";
        } catch (\Exception $e) {
            echo "Error: Puede que el usuario ya tenga ese rol o no exista.\n";
        }
    }
}