<?php

use yii\db\Migration;

/**
 * Class m260109_021500_add_servicio_id_to_cursos
 */
class m260109_021500_add_servicio_id_to_cursos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cursos}}', 'servicio_id', $this->integer()->after('id'));
        
        // Opcional: Agregar clave foránea si la tabla servicios existe
        // $this->addForeignKey('fk-cursos-servicio_id', '{{%cursos}}', 'servicio_id', '{{%servicios}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cursos}}', 'servicio_id');
    }
}
