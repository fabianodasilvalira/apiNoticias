<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reacao".
 *
 * @property int $id_user
 * @property string $reacao
 * @property string $objeto
 * @property int $id_objeto Referenciar o id de Comentário ou de Notícia
 *
 * @property User $user
 */
class Reacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'reacao', 'id_objeto'], 'required'],
            [['id_user', 'id_objeto'], 'integer'],
            [['objeto', 'reacao'], 'string', 'max' => 50],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'reacao' => 'Reacao',
            'objeto' => 'Objeto',
            'id_objeto' => 'Id Objeto',
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
