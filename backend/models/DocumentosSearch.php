<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documentos;

/**
 * DocumentosSearch represents the model behind the search form of `common\models\Documentos`.
 */
class DocumentosSearch extends Documentos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proyecto_id', 'tamaño_bytes', 'visible_cliente', 'subido_por'], 'integer'],
            [['nombre_archivo', 'descripcion', 'ruta_archivo', 'tipo_documento', 'version', 'hash_verificacion', 'fecha_subida', 'fecha_modificacion', 'notas'], 'safe'],
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
        $query = Documentos::find();

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
            'tamaño_bytes' => $this->tamaño_bytes,
            'visible_cliente' => $this->visible_cliente,
            'subido_por' => $this->subido_por,
            'fecha_subida' => $this->fecha_subida,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre_archivo', $this->nombre_archivo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'ruta_archivo', $this->ruta_archivo])
            ->andFilterWhere(['like', 'tipo_documento', $this->tipo_documento])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'hash_verificacion', $this->hash_verificacion])
            ->andFilterWhere(['like', 'notas', $this->notas]);

        return $dataProvider;
    }
}
