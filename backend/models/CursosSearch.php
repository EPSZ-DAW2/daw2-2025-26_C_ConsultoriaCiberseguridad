<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cursos;

/**
 * CursosSearch represents the model behind the search form of `common\models\Cursos`.
 */
class CursosSearch extends Cursos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activo', 'creado_por', 'modificado_por'], 'integer'],
            [['nombre', 'descripcion', 'imagen_portada', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nota_minima_aprobado'], 'number'],
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
        $query = Cursos::find();

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
            'nota_minima_aprobado' => $this->nota_minima_aprobado,
            'activo' => $this->activo,
            'creado_por' => $this->creado_por,
            'fecha_creacion' => $this->fecha_creacion,
            'modificado_por' => $this->modificado_por,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen_portada', $this->imagen_portada]);

        return $dataProvider;
    }
}
