<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Incidencias;

/**
 * IncidenciasSearch represents the model behind the search form of `common\models\Incidencias`.
 */
class IncidenciasSearch extends Incidencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'analista_id', 'tiempo_resolucion', 'sla_cumplido', 'visible_cliente'], 'integer'],
            [['titulo', 'descripcion', 'severidad', 'estado_incidencia', 'categoria_incidencia', 'fecha_reporte', 'fecha_asignacion', 'fecha_primera_respuesta', 'fecha_resolucion', 'ip_origen', 'sistema_afectado', 'acciones_tomadas', 'notas_internas'], 'safe'],
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
        $query = Incidencias::find();

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
            'analista_id' => $this->analista_id,
            'fecha_reporte' => $this->fecha_reporte,
            'fecha_asignacion' => $this->fecha_asignacion,
            'fecha_primera_respuesta' => $this->fecha_primera_respuesta,
            'fecha_resolucion' => $this->fecha_resolucion,
            'tiempo_resolucion' => $this->tiempo_resolucion,
            'sla_cumplido' => $this->sla_cumplido,
            'visible_cliente' => $this->visible_cliente,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'severidad', $this->severidad])
            ->andFilterWhere(['like', 'estado_incidencia', $this->estado_incidencia])
            ->andFilterWhere(['like', 'categoria_incidencia', $this->categoria_incidencia])
            ->andFilterWhere(['like', 'ip_origen', $this->ip_origen])
            ->andFilterWhere(['like', 'sistema_afectado', $this->sistema_afectado])
            ->andFilterWhere(['like', 'acciones_tomadas', $this->acciones_tomadas])
            ->andFilterWhere(['like', 'notas_internas', $this->notas_internas]);

        return $dataProvider;
    }
}
