<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property string $descricao_categoria
 * @property string $url_categoria
 * @property string $imagem_categoria
 *
 * @property Noticias[] $noticias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao_categoria', 'url_categoria', 'imagem_categoria'], 'required'],
            [['descricao_categoria'], 'string', 'max' => 50],
            [['url_categoria', 'imagem_categoria'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'descricao_categoria' => 'Descricao Categoria',
            'url_categoria' => 'Url Categoria',
            'imagem_categoria' => 'Imagem Categoria',
        ];
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticias::className(), ['id_categoria' => 'id_categoria']);
    }
}
