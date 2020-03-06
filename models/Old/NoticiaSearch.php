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
            [['id_noticias', 'id_categoria', 'ativo'], 'integer'],
            [['titulo_noticia', 'descricao_noticia', 'autor_noticia', 'data_noticia', 'image_noticia'], 'safe'],
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
            'id_noticias' => $this->id_noticias,
            'id_categoria' => $this->id_categoria,
            'data_noticia' => $this->data_noticia,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'titulo_noticia', $this->titulo_noticia])
            ->andFilterWhere(['like', 'descricao_noticia', $this->descricao_noticia])
            ->andFilterWhere(['like', 'autor_noticia', $this->autor_noticia])
            ->andFilterWhere(['like', 'image_noticia', $this->image_noticia]);

        return $dataProvider;
    }
}
