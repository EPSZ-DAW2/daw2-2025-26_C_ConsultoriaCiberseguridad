<?php

use yii\db\Migration;

/**
 * Class m260111_000002_revoke_commercial_calendar
 */
class m260111_000002_revoke_commercial_calendar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('comercial');
        
        if ($role) {
            // Permissions to remove
            $permissions = ['verCalendario', 'escribirCalendario'];
            
            foreach ($permissions as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                if ($permission && $auth->hasChild($role, $permission)) {
                    $auth->removeChild($role, $permission);
                    echo "Revoked $permissionName from comercial.\n";
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('comercial');
        
        if ($role) {
            // Permissions to restore
            $permissions = ['verCalendario', 'escribirCalendario'];
            
            foreach ($permissions as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                if ($permission && !$auth->hasChild($role, $permission)) {
                    $auth->addChild($role, $permission);
                    echo "Restored $permissionName to comercial.\n";
                }
            }
        }
    }
}
