<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%usuarios}}`.

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%usuarios}}`.
 */
class m260108_105433_add_totp_secret_column_to_usuarios_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%usuarios}}', 'totp_secret', $this->string()->defaultValue(null));
        $this->addColumn('{{%usuarios}}', 'totp_activo', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%usuarios}}', 'totp_activo');
        $this->dropColumn('{{%usuarios}}', 'totp_secret');
    }
}
