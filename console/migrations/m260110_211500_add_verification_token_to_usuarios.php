<?php

use yii\db\Migration;

/**
 * Class m260110_211500_add_verification_token_to_usuarios
 */
class m260110_211500_add_verification_token_to_usuarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%usuarios}}', 'verification_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%usuarios}}', 'verification_token');
    }
}
