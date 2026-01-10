<?php

use yii\db\Migration;

/**
 * Class m260110_214000_add_password_reset_token_to_usuarios
 */
class m260110_214000_add_password_reset_token_to_usuarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%usuarios}}', 'password_reset_token', $this->string()->unique()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%usuarios}}', 'password_reset_token');
    }
}
