<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property string $nome
 * @property string $path
 * @property string|null $titulo
 * @property string|null $descricao
 * @property string|null $fonte_nm Nome da fonte da imagem, se não for própria
 * @property string|null $fonte_url URL da fonte da imagem, se não for própria
 * @property string $objeto
 * @property int $id_objeto Referenciar o id de Categoria ou de Notícia
 * @property int $id_user
 * @property int $status
 * @property string $dt_in
 * @property string $dt_up
 * @property string|null $logs
 *
 * @property User $user
 */
class Imagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'path', 'id_objeto', 'id_user'], 'required'],
            [['id_objeto', 'id_user', 'status'], 'integer'],
            [['dt_in', 'dt_up'], 'safe'],
            [['objeto', 'logs'], 'string'],
            [['nome'], 'string', 'max' => 150],
            [['path', 'titulo', 'descricao', 'fonte_url'], 'string', 'max' => 255],
            [['fonte_nm'], 'string', 'max' => 100],
            [['nome'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'path' => 'Path',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'fonte_nm' => 'Fonte Nm',
            'fonte_url' => 'Fonte Url',
            'objeto' => 'Objeto',
            'id_objeto' => 'Id Objeto',
            'id_user' => 'Id User',
            'status' => 'Status',
            'dt_in' => 'Dt In',
            'dt_up' => 'Dt Up',
            'logs' => 'Logs',
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
}