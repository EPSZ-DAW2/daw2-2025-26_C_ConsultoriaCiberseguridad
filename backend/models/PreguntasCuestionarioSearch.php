<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PreguntasCuestionario;

/**
 * PreguntasCuestionarioSearch represents the model behind the search form of `common\models\PreguntasCuestionario`.
 */
class PreguntasCuestionarioSearch extends PreguntasCuestionario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'curso_id', 'creado_por', 'modificado_por'], 'integer'],
            [['enunciado_pregunta', 'opcion_a', 'opcion_b', 'opcion_c', 'opcion_correcta', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
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
        $query = PreguntasCuestionario::find();

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
            'curso_id' => $this->curso_id,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'enunciado_pregunta', $this->enunciado_pregunta])
            ->andFilterWhere(['like', 'opcion_a', $this->opcion_a])
            ->andFilterWhere(['like', 'opcion_b', $this->opcion_b])
            ->andFilterWhere(['like', 'opcion_c', $this->opcion_c])
            ->andFilterWhere(['like', 'opcion_correcta', $this->opcion_correcta]);

        return $dataProvider;
    }
}
