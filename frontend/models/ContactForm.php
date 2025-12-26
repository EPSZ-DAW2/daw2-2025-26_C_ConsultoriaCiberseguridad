<?php

namespace frontend\models;

use yii\base\Model;

class ContactForm extends Model
{
    public $nombre;
    public $apellidos;
    public $email;
    public $mensaje;

    public function rules()
    {
        return [
            [['nombre', 'apellidos', 'email', 'mensaje'], 'required'],
            ['email', 'email'],
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 500],
            [['mensaje'], 'string', 'max' => 2000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email' => 'Email',
            'mensaje' => 'Mensaje',
        ];
    }
}
