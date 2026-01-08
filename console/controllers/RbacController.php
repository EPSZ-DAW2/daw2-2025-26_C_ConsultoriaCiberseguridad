<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    // php yii rbac/init
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

        $gestionarFormacion = $auth->createPermission('gestionarFormacion');
        $gestionarFormacion->description = 'Gestionar cursos de formación y contenido educativo';
        $auth->add($gestionarFormacion);

        // Permisos para manager y comercial
        $verRentabilidad = $auth->createPermission('verRentabilidad');
        $verRentabilidad->description = 'Ver métricas de rentabilidad y reportes';
        $auth->add($verRentabilidad);

        $asignarRecursos = $auth->createPermission('asignarRecursos');
        $asignarRecursos->description = 'Asignar consultores/auditores a proyectos';
        $auth->add($asignarRecursos);

        $gestionarCRM = $auth->createPermission('gestionarCRM');
        $gestionarCRM->description = 'Gestionar clientes potenciales y leads';
        $auth->add($gestionarCRM);

        $gestionarCatalogo = $auth->createPermission('gestionarCatalogo');
        $gestionarCatalogo->description = 'Editar catálogo de servicios';
        $auth->add($gestionarCatalogo);

        // Permisos para analista SOC
        $verMonitorizacion = $auth->createPermission('verMonitorizacion');
        $verMonitorizacion->description = 'Ver dashboard SOC 24/7';
        $auth->add($verMonitorizacion);

        $gestionarTickets = $auth->createPermission('gestionarTickets');
        $gestionarTickets->description = 'Gestionar incidencias SOC';
        $auth->add($gestionarTickets);

        // Permisos para clientes (frontend)
        $gestionarEmpresa = $auth->createPermission('gestionarEmpresa');
        $gestionarEmpresa->description = 'Dashboard empresa y gestionar empleados';
        $auth->add($gestionarEmpresa);

        $verFacturacion = $auth->createPermission('verFacturacion');
        $verFacturacion->description = 'Ver facturas de la empresa';
        $auth->add($verFacturacion);

        $verMisCursos = $auth->createPermission('verMisCursos');
        $verMisCursos->description = 'Acceder a formación asignada';
        $auth->add($verMisCursos);

        $reportarIncidencia = $auth->createPermission('reportarIncidencia');
        $reportarIncidencia->description = 'Crear tickets de incidencias';
        $auth->add($reportarIncidencia);

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
        $auth->addChild($consultor, $gestionarFormacion);

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

        // Roles nuevos del backend
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $verPanel);
        $auth->addChild($manager, $verDocs);
        $auth->addChild($manager, $escribirCalendario);
        $auth->addChild($manager, $verRentabilidad);
        $auth->addChild($manager, $asignarRecursos);

        $comercial = $auth->createRole('comercial');
        $auth->add($comercial);
        $auth->addChild($comercial, $verPanel);
        $auth->addChild($comercial, $gestionarCatalogo);
        $auth->addChild($comercial, $gestionarCRM);
        $auth->addChild($comercial, $escribirCalendario);

        // Migrar analista_soc al sistema RBAC
        $analistaSoc = $auth->createRole('analista_soc');
        $auth->add($analistaSoc);
        $auth->addChild($analistaSoc, $verPanel);
        $auth->addChild($analistaSoc, $verMonitorizacion);
        $auth->addChild($analistaSoc, $gestionarTickets);

        // Roles nuevos del frontend (clientes)
        $clienteAdmin = $auth->createRole('cliente_admin');
        $auth->add($clienteAdmin);
        $auth->addChild($clienteAdmin, $verMisProyectos);
        $auth->addChild($clienteAdmin, $gestionarEmpresa);
        $auth->addChild($clienteAdmin, $verFacturacion);
        $auth->addChild($clienteAdmin, $verMisCursos);
        $auth->addChild($clienteAdmin, $reportarIncidencia);

        $clienteUser = $auth->createRole('cliente_user');
        $auth->add($clienteUser);
        $auth->addChild($clienteUser, $verMisCursos);
        $auth->addChild($clienteUser, $reportarIncidencia);

        // Admin hereda de todos los roles
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $comercial);
        $auth->addChild($admin, $analistaSoc);
        $auth->addChild($admin, $clienteAdmin);
        $auth->addChild($admin, $clienteUser);

        echo "¡Roles creados con éxito! :)\n";
    }

    //php yii rbac/assign <rol> <id_usuario>
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