<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticia;

/**
 * NoticiaSearch represents the model behind the search form of `app\models\Noticia`.
 */
class NoticiaSearch extends Noticia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_categoria', 'id_user', 'status'], 'integer'],
            [['titulo', 'corpo', 'fonte_nm', 'fonte_url', 'dt_publicacao', 'dt_in', 'dt_up', 'logs'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Noticia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_categoria' => $this->id_categoria,
            'dt_publicacao' => $this->dt_publicacao,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'dt_in' => $this->dt_in,
            'dt_up' => $this->dt_up,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'corpo', $this->corpo])
            ->andFilterWhere(['like', 'fonte_nm', $this->fonte_nm])
            ->andFilterWhere(['like', 'fonte_url', $this->fonte_url])
            ->andFilterWhere(['like', 'logs', $this->logs]);

        return $dataProvider;
    }
}
