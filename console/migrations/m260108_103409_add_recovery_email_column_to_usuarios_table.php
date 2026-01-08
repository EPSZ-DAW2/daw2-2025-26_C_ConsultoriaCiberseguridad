<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%usuarios}}`.

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%usuarios}}`.
 */
class m260108_103409_add_recovery_email_column_to_usuarios_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%usuarios}}', 'email_recuperacion', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%usuarios}}', 'email_recuperacion');
    }
}
