<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Proyectos;

/**
 * ProyectosSearch represents the model behind the search form of `common\models\Proyectos`.
 */
class ProyectosSearch extends Proyectos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'servicio_id', 'consultor_id', 'auditor_id', 'creado_por', 'modificado_por'], 'integer'],
            [['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin_prevista', 'fecha_fin_real', 'estado', 'notas_internas', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['presupuesto'], 'number'],
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
        $query = Proyectos::find();

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
            'cliente_id' => $this->cliente_id,
            'servicio_id' => $this->servicio_id,
            'consultor_id' => $this->consultor_id,
            'auditor_id' => $this->auditor_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin_prevista' => $this->fecha_fin_prevista,
            'fecha_fin_real' => $this->fecha_fin_real,
            'presupuesto' => $this->presupuesto,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'notas_internas', $this->notas_internas]);

        return $dataProvider;
    }
}
