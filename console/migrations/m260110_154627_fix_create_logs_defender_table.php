<?php

use yii\db\Migration;

class m260110_154627_fix_create_logs_defender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Drop previo por seguridad (si falló la anterior)
        $this->execute("DROP TABLE IF EXISTS {{%logs_defender}}");

        $this->createTable('{{%logs_defender}}', [
            'id' => $this->primaryKey(),
            'evento' => $this->string()->notNull(),
            'fuente' => $this->string(100)->notNull()->defaultValue('Microsoft Defender'),
            'gravedad' => "ENUM('Crítica', 'Alta', 'Media', 'Baja', 'Informativa') NOT NULL DEFAULT 'Media'",
            'fecha' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'cliente_afectado_id' => $this->integer()->null(), // Solo columna, sin FK estricta
            'sistema' => $this->string(100)->null(),
            'estado' => "ENUM('Pendiente', 'Procesado', 'Ignorado') NOT NULL DEFAULT 'Pendiente'",
            'detalles_tecnicos' => $this->text()->null(),
        ]);
        
        // Creamos indice pero no FK para evitar errores 150
        $this->createIndex(
            'idx-logs_defender-cliente_id',
            '{{%logs_defender}}',
            'cliente_afectado_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logs_defender}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260110_154627_fix_create_logs_defender_table cannot be reverted.\n";

        return false;
    }
    */
}
