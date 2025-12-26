<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Servicios;

/**
 * ServiciosSearch represents the model behind the search form of `common\models\Servicios`.
 */
class ServiciosSearch extends Servicios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'duracion_estimada', 'requiere_auditoria', 'activo', 'creado_por', 'modificado_por'], 'integer'],
            [['nombre', 'descripcion', 'categoria', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['precio_base'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Servicios::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'precio_base' => $this->precio_base,
            'duracion_estimada' => $this->duracion_estimada,
            'requiere_auditoria' => $this->requiere_auditoria,
            'activo' => $this->activo,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'categoria', $this->categoria]);

        return $dataProvider;
    }
}
