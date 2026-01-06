<?php

use yii\db\Migration;

/**
 * Class m260105_000001_add_video_url_to_cursos_table
 */
class m260105_000001_add_video_url_to_cursos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add video_url column
        // We check if it exists first just in case, though standard migration shouldn't need this if controlled.
        // But safeUp is modifying schema.
        $this->addColumn('{{%cursos}}', 'video_url', $this->string(255)->after('descripcion'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cursos}}', 'video_url');
    }
}
