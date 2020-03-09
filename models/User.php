<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $name
 * @property string $cpf
 * @property string $phone
 * @property string $perfil
 * @property XUserEntidade[] $xUserEntidades
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INSERTED = 5;
    const STATUS_ACTIVE = 10;
    //`perfil` enum ('Administrador','Financeira', 'Municipio'),

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public function getXUserEntidades()
    {
        return $this->hasMany(XUserEntidade::className(), ['id_user' => 'id']);
    }
}


// use Yii;

// /**
//  * This is the model class for table "user".
//  *
//  * @property int $id ID
//  * @property string $username User Name
//  * @property string $email e-mail
//  * @property string $name Nome
//  * @property string|null $phone Telefone
//  * @property string|null $perfil
//  * @property string $auth_key
//  * @property string $password_hash
//  * @property string|null $password_reset_token
//  * @property int $status
//  * @property int $created_at
//  * @property int $updated_at
//  * @property string $dt_in
//  * @property string $dt_up
//  * @property string|null $permissions
//  * @property string|null $logs
//  *
//  * @property Categoria[] $categorias
//  * @property Comentario[] $comentarios
//  * @property Imagem[] $imagems
//  * @property Noticia[] $noticias
//  * @property Reacao[] $reacaos
//  */
// class User extends \yii\db\ActiveRecord
// {
//     /**
//      * {@inheritdoc}
//      */
//     public static function tableName()
//     {
//         return 'user';
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function rules()
//     {
//         return [
//             [['username', 'email', 'name', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
//             [['perfil', 'permissions', 'logs'], 'string'],
//             [['status', 'created_at', 'updated_at'], 'integer'],
//             [['dt_in', 'dt_up'], 'safe'],
//             [['username', 'email', 'name', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
//             [['phone'], 'string', 'max' => 20],
//             [['auth_key'], 'string', 'max' => 32],
//             [['username'], 'unique'],
//         ];
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function attributeLabels()
//     {
//         return [
//             'id' => 'ID',
//             'username' => 'Username',
//             'email' => 'Email',
//             'name' => 'Name',
//             'phone' => 'Phone',
//             'perfil' => 'Perfil',
//             'auth_key' => 'Auth Key',
//             'password_hash' => 'Password Hash',
//             'password_reset_token' => 'Password Reset Token',
//             'status' => 'Status',
//             'created_at' => 'Created At',
//             'updated_at' => 'Updated At',
//             'dt_in' => 'Dt In',
//             'dt_up' => 'Dt Up',
//             'permissions' => 'Permissions',
//             'logs' => 'Logs',
//         ];
//     }

//     /**
//      * Gets query for [[Categorias]].
//      *
//      * @return \yii\db\ActiveQuery
//      */
//     public function getCategorias()
//     {
//         return $this->hasMany(Categoria::className(), ['user' => 'id']);
//     }

//     /**
//      * Gets query for [[Comentarios]].
//      *
//      * @return \yii\db\ActiveQuery
//      */
//     public function getComentarios()
//     {
//         return $this->hasMany(Comentario::className(), ['user' => 'id']);
//     }

//     /**
//      * Gets query for [[Imagems]].
//      *
//      * @return \yii\db\ActiveQuery
//      */
//     public function getImagems()
//     {
//         return $this->hasMany(Imagem::className(), ['user' => 'id']);
//     }

//     /**
//      * Gets query for [[Noticias]].
//      *
//      * @return \yii\db\ActiveQuery
//      */
//     public function getNoticias()
//     {
//         return $this->hasMany(Noticia::className(), ['user' => 'id']);
//     }

//     /**
//      * Gets query for [[Reacaos]].
//      *
//      * @return \yii\db\ActiveQuery
//      */
//     public function getReacaos()
//     {
//         return $this->hasMany(Reacao::className(), ['user' => 'id']);
//     }
// }
