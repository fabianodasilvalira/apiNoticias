<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $descricao
 * @property int $id_user
 * @property int $status
 * @property string $dt_in
 * @property string $dt_up
 * @property string|null $logs
 *
 * @property User $user
 * @property Noticia[] $noticias
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
            [['nome', 'id_user'], 'required'],
            [['descricao', 'logs'], 'string'],
            [['id_user', 'status'], 'integer'],
            [['dt_in', 'dt_up'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'id_user' => 'User',
            'status' => 'Status',
        ];
    }

    public function fields()
    {
        return[
            'id',
            'nome',
            'descricao',
            'status',
            'imagem',
            // 'noticias',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getNoticias()
    // {
    //     return $this->hasMany(Noticia::className(), ['id_categoria' => 'id']);
    // }

    public function getImagem()
    {
        $img = $this->hasMany(Imagem::className(), ['id_objeto' => 'id'])->onCondition(['objeto' => 'Categoria'])->one();
        return $img->path . $img->nome;
    }
}
