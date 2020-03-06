<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagem;

/**
 * ImagemSearch represents the model behind the search form of `app\models\Imagem`.
 */
class ImagemSearch extends Imagem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'path', 'titulo', 'descricao', 'fonte_nm', 'fonte_url', 'dt_in', 'dt_up', 'logs'], 'safe'],
            [['objeto', 'id_objeto', 'id_user', 'status'], 'integer'],
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
        $query = Imagem::find();

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
            'objeto' => $this->objeto,
            'id_objeto' => $this->id_objeto,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'dt_in' => $this->dt_in,
            'dt_up' => $this->dt_up,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'fonte_nm', $this->fonte_nm])
            ->andFilterWhere(['like', 'fonte_url', $this->fonte_url])
            ->andFilterWhere(['like', 'logs', $this->logs]);

        return $dataProvider;
    }
}
