<?php

namespace app\modules\controllers;

use yii\rest\ActiveController;
use app\models\Imagem;

class ImagemController extends ActiveController
{

public $modelClass = 'app\models\Imagem';

	public function actionPorNoticia($id)
	{	
		return Imagem::find()->where(['id_objeto' => $id, 'objeto' => 'Noticia'])->all();
	}

	public function actionPorCategoria($id)
	{	
		return Imagem::find()->where(['id_objeto' => $id, 'objeto' => 'Categoria'])->all();
	}
}
