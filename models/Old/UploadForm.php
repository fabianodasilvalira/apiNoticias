<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            // gerar a parada para nomear o arquivo aqui
            $dirFile = 'img/noticias/';
            $nmFile = time() . '_' . $this->imageFile->baseName;
            $extFile = $this->imageFile->extension;
            // cria o diretório se não existir
            if (!is_dir($dirFile)){
                mkdir($dirFile, 0755, true);
            }
            if ($this->imageFile->saveAs($dirFile . $nmFile . '.' . $extFile)){
                // Se ele salvar, inserir a url no BD aqui...
                
            }
            // quando salva retorna o diretorio e nome do arquivo
            return $dirFile . $nmFile . '.' . $extFile;

        } else {
            return false;
        }
    }
}