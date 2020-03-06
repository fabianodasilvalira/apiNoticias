<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property int $id_user
 * @property string $mensagem
 * @property string $objeto
 * @property int $id_objeto Referenciar o id de Comentário ou de Notícia
 * @property int $status
 * @property string $dt_in
 * @property string $dt_up
 * @property string|null $logs
 *
 * @property User $user
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'mensagem', 'id_objeto'], 'required'],
            [['id_user', 'id_objeto', 'status'], 'integer'],
            [['objeto', 'mensagem', 'logs'], 'string'],
            [['dt_in', 'dt_up'], 'safe'],
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
            'id_user' => 'User',
            'mensagem' => 'Mensagem',
            'objeto' => 'Objeto',
            'id_objeto' => 'Id Objeto',
            'status' => 'Status',
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

    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_objeto' => 'id', 'objeto' => 'Comentario']);
    }

    // public function getObjeto()
    // {
    //     return $this->hasOne(User::className(), ['id' => 'id_user']);
    // }
}
