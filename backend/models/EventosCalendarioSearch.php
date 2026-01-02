<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventosCalendario;

/**
 * EventosCalendarioSearch represents the model behind the search form of `common\models\EventosCalendario`.
 */
class EventosCalendarioSearch extends EventosCalendario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proyecto_id', 'auditor_id', 'recordatorio_enviado', 'creado_por', 'modificado_por'], 'integer'],
            [['titulo', 'descripcion', 'fecha', 'hora_inicio', 'hora_fin', 'tipo_evento', 'ubicacion', 'estado_evento', 'notas', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
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
        $query = EventosCalendario::find();

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
            'proyecto_id' => $this->proyecto_id,
            'auditor_id' => $this->auditor_id,
            'fecha' => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'recordatorio_enviado' => $this->recordatorio_enviado,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'tipo_evento', $this->tipo_evento])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion])
            ->andFilterWhere(['like', 'estado_evento', $this->estado_evento])
            ->andFilterWhere(['like', 'notas', $this->notas]);

        return $dataProvider;
    }
}
