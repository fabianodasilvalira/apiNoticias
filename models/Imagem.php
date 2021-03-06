<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

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
     * @var UploadedFile
     */
    public $imageFiles;

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
            
            [['nome', 'path', 'id_objeto', 'id_user', 'objeto'], 'required'],
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

    public function load($data, $formName = NULL)
    {
        // echo "<pre>";
        // var_dump($data);
        // die;
        //$this->imageFile = UploadedFile::getInstance($data, 'imageFile');
        $this->id_user = Yii::$app->user->id;
        $this->objeto = key(array_diff_key($data, ["_csrf" => "", "Imagem" => ""]));
        return $this->upload();

        // VarDumper::dump($r, 10, true);
        // die;
    }

    private function upload()
    {
        if ($this->imageFiles = UploadedFile::getInstances($this, 'imageFiles')){
            $this->path = 'img/' . $this->objeto . '/';
            $this->nome = $this->path . time() . '_';
            // cria o diretório se não existir
            if (!is_dir($this->path))
                mkdir($this->path, 0755, true);
            
            // echo "<pre>";
            // var_dump($this->imageFiles);
            // die;

            if ($this->validate()){
                foreach ($this->imageFiles as $key => $file) {
                    $i = new Imagem();
                    $i->nome = $this->nome;
                    $i->path = $this->path;
                    $i->id_objeto = $this->id_objeto;
                    $i->id_user = $this->id_user;
                    $i->objeto = $this->objeto;

                    $i->nome .= md5($file->baseName) . '.' . $file->extension;

                    $file->saveAs($i->nome);
                    $i->save();
                    
                    $this->imageFiles[$key]->tempName = $i->nome;
                }

                return $this->nome;
            }
        }
        
        return false;
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

    public function save($runValidation = true, $attributeNames = NULL)
    {
        return parent::save($runValidation, $attributeNames);
    }
}
