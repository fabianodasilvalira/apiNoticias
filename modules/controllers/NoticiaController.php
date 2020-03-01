<?php

namespace app\modules\controllers;

use yii\rest\ActiveController;
use app\models\Noticia;

class NoticiaController extends ActiveController
{

public $modelClass = 'app\models\Noticia';

	public function actionPorCategoria($id)
	{	
		return Noticia::find()->where(['id_categoria' => $id])->all();
	}
}
