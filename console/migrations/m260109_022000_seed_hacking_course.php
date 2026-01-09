<?php

use yii\db\Migration;

/**
 * Class m260109_022000_seed_hacking_course
 */
class m260109_022000_seed_hacking_course extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Crear el Servicio de Formación
        $this->insert('{{%servicios}}', [
            'nombre' => 'Formación: Hacking Ético Básico',
            'descripcion' => 'Curso introductorio sobre seguridad ofensiva y defensa.',
            'categoria' => 'Formacion', // Debe coincidir con el ENUM
            'precio_base' => 150.00,
            'duracion_estimada' => 10,
            'requiere_auditoria' => 0,
            'activo' => 1,
            'fecha_creacion' => date('Y-m-d H:i:s'),
        ]);

        // Recuperar el ID del servicio recién creado
        $servicioId = $this->db->getLastInsertID();

        // 2. Crear el Curso
        $this->insert('{{%cursos}}', [
            'nombre' => 'Introducción al Phishing',
            'descripcion' => 'Aprende a identificar y protegerte de los ataques de suplantación de identidad.',
            'video_url' => 'https://www.youtube.com/watch?v=iN4-rdfx3ZE', 
            'servicio_id' => $servicioId,
            'nota_minima_aprobado' => 7.00,
            'activo' => 1,
            'fecha_creacion' => date('Y-m-d H:i:s'),
        ]);

        $cursoId = $this->db->getLastInsertID();

        // 3. Crear Diapositivas
        $slides = [
            [
                'curso_id' => $cursoId,
                'numero_orden' => 1,
                'titulo' => '¿Qué es el Phishing?',
                'contenido_html' => '<p>El <strong>Phishing</strong> es una técnica de ciberdelincuencia que utiliza el fraude, el engaño y el timo para manipular a sus víctimas y hacer que revelen información personal confidencial.</p><ul><li>Suplantación de bancos</li><li>Correos falsos de RRHH</li><li>Premios inexistentes</li></ul>',
                'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Phishing_trusted_bank.svg/1200px-Phishing_trusted_bank.svg.png',
                'video_url' => null,
            ],
            [
                'curso_id' => $cursoId,
                'numero_orden' => 2,
                'titulo' => 'Ejemplo en Video',
                'contenido_html' => '<p>Mira este video para entender cómo operan los cibercriminales en tiempo real.</p>',
                'imagen_url' => null,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 
            ],
            [
                'curso_id' => $cursoId,
                'numero_orden' => 3,
                'titulo' => 'Cómo protegerse',
                'contenido_html' => '<h3>Tips de Seguridad</h3><ol><li>Verifica siempre el remitente (@empresa.com no @gmail.com).</li><li>No hagas clic en enlaces sospechosos ("Tu cuenta ha sido bloqueada").</li><li>Activa el doble factor de autenticación (2FA).</li></ol><p>¡Estás listo para el examen!</p>',
                'imagen_url' => null,
                'video_url' => null,
            ],
        ];

        foreach ($slides as $slide) {
            $this->insert('{{%diapositivas}}', $slide);
        }

        // 4. Crear Preguntas del Examen
        $preguntas = [
            [
                'curso_id' => $cursoId,
                'enunciado_pregunta' => '¿Cuál de los siguientes es un indicio claro de Phishing?',
                'opcion_a' => 'El correo viene de @mibanco.com.',
                'opcion_b' => 'El correo tiene faltas de ortografía y mete urgencia ("¡Hazlo ya!").',
                'opcion_c' => 'El correo incluye mi nombre completo.',
                'opcion_correcta' => 'b',
            ],
            [
                'curso_id' => $cursoId,
                'enunciado_pregunta' => 'Si recibo un correo sospechoso, ¿qué debo hacer?',
                'opcion_a' => 'Responder preguntando si es real.',
                'opcion_b' => 'Hacer clic en el enlace para verificar.',
                'opcion_c' => 'Contactar a la entidad por otro medio oficial y borrar el correo.',
                'opcion_correcta' => 'c',
            ],
             [
                'curso_id' => $cursoId,
                'enunciado_pregunta' => '¿Qué significa el candado verde en el navegador?',
                'opcion_a' => 'Que el sitio es 100% legítimo y seguro.',
                'opcion_b' => 'Que la conexión está cifrada, pero el sitio podría ser fraudulento.',
                'opcion_c' => 'Que Google ha verificado la empresa.',
                'opcion_correcta' => 'b',
            ],
        ];

        foreach ($preguntas as $pregunta) {
            $this->insert('{{%preguntas_cuestionario}}', $pregunta);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Borramos en orden inverso para respetar Claves Foráneas
        
        // 1. Necesitamos buscar el Curso para borrar sus hijos (SQLite/MySQL a veces no hace cascada si no está configurado)
        // Buscamos por nombre para ser específicos
        $curso = (new \yii\db\Query())
            ->select(['id'])
            ->from('{{%cursos}}')
            ->where(['nombre' => 'Introducción al Phishing'])
            ->one();

        if ($curso) {
            $id = $curso['id'];
            $this->delete('{{%preguntas_cuestionario}}', ['curso_id' => $id]);
            $this->delete('{{%diapositivas}}', ['curso_id' => $id]);
            $this->delete('{{%cursos}}', ['id' => $id]);
        }

        $this->delete('{{%servicios}}', ['nombre' => 'Formación: Hacking Ético Básico']);
    }
}
