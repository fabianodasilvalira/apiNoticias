<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id ID
 * @property string $username User Name
 * @property string $email e-mail
 * @property string $name Nome
 * @property string|null $phone Telefone
 * @property string|null $perfil
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $dt_in
 * @property string $dt_up
 * @property string|null $permissions
 * @property string|null $logs
 *
 * @property Categoria[] $categorias
 * @property Comentario[] $comentarios
 * @property Imagem[] $imagems
 * @property Noticia[] $noticias
 * @property Reacao[] $reacaos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'name', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['perfil', 'permissions', 'logs'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['dt_in', 'dt_up'], 'safe'],
            [['username', 'email', 'name', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'name' => 'Name',
            'phone' => 'Phone',
            'perfil' => 'Perfil',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dt_in' => 'Dt In',
            'dt_up' => 'Dt Up',
            'permissions' => 'Permissions',
            'logs' => 'Logs',
        ];
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Reacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReacaos()
    {
        return $this->hasMany(Reacao::className(), ['user' => 'id']);
    }
}
