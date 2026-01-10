<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%incidencias}}`.
 */
class m260110_161354_add_origen_column_to_incidencias_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%incidencias}}', 'origen', $this->string(100)->null()->defaultValue('Manual'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%incidencias}}', 'origen');
    }
}
