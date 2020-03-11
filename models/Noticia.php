<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property int $id
 * @property int $id_categoria
 * @property string $titulo
 * @property string $corpo
 * @property string|null $fonte_nm Nome da fonte da notícia, se não for própria
 * @property string|null $fonte_url URL da fonte da notícia, se não for própria
 * @property string $dt_publicacao
 * @property int $id_user
 * @property int $status
 * @property string $dt_in
 * @property string $dt_up
 * @property string|null $logs
 *
 * @property User $user
 * @property Categoria $categoria
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'titulo', 'corpo', 'id_user'], 'required'],
            [['id_categoria', 'id_user', 'status'], 'integer'],
            [['corpo', 'logs'], 'string'],
            [['dt_publicacao', 'dt_in', 'dt_up'], 'safe'],
            [['titulo', 'fonte_url'], 'string', 'max' => 255],
            [['fonte_nm'], 'string', 'max' => 100],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_categoria' => 'Categoria',
            'titulo' => 'Titulo',
            'corpo' => 'Corpo',
            'fonte_nm' => 'Nome da Fonte',
            'fonte_url' => 'URL da Fonte',
            'dt_publicacao' => 'Data de Publicação',
            'id_user' => 'User',
            'status' => 'Status',
            
            'categoria.nome' => 'Categoria',
            'user.username' => 'User',
            'imagem.nome' => 'Imagem',
        ];
    }

    public function fields()
    {
        return[
            'id',
            'id_categoria',
            'titulo',
            'corpo',
            'fonte_nm',
            'fonte_url',
            'dt_publicacao',
            'status',
            'imagens',
            'categoria',
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
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_objeto' => 'id']->onCondition(['objeto' => 'Noticia']));
    }

    public function getImagens()
    {
        return $this->hasMany(Imagem::className(), ['id_objeto' => 'id'])->onCondition(['objeto' => 'Noticia']);
    }

    public function getImagem()
    {
        return $this->getImagens()->one();
        // return $this->hasMany(Imagem::className(), ['id_objeto' => 'id'])->onCondition(['objeto' => 'Noticia'])->one();
    }
}
