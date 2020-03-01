<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id_noticias
 * @property int $id_categoria
 * @property string $titulo_noticia
 * @property string $descricao_noticia
 * @property string $autor_noticia
 * @property string $data_noticia
 * @property string $image_noticia
 * @property int $ativo
 *
 * @property Categoria $categoria
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }
    
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'titulo_noticia', 'descricao_noticia', 'autor_noticia', 'data_noticia' ], 'required'],
            [['id_categoria', 'ativo'], 'integer'],
            [['data_noticia'], 'safe'],
            [['titulo_noticia', 'descricao_noticia', 'autor_noticia'], 'string', 'max' => 150],
            [['image_noticia'], 'string', 'max' => 50],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            // [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_noticias' => 'Id Noticias',
            'id_categoria' => 'Id Categoria',
            'titulo_noticia' => 'Titulo Noticia',
            'descricao_noticia' => 'Descricao Noticia',
            'autor_noticia' => 'Autor Noticia',
            'data_noticia' => 'Data Noticia',
            'imageFile' => 'Imagem da notícia',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria']);
    }

    public function fields(){
        return [
            'id_noticias',
            'titulo_noticia',
            'descricao_noticia',
            'autor_noticia',
            'data_noticia',
            'ativo'=>function(Noticia $model){
                return ($model->ativo == '1' ? 'Ativo' : 'Inativo');
            },
            'categoria',
            // 'id_categoria',
            
        ];
    }

    public function extraFields(){
        return [
            'categoria',
        ];
    }
    
}