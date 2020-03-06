<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?php //$form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_categoria')->DropdownList($categorias) ?>
    
    <?= $form->field($model, 'titulo_noticia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_noticia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'autor_noticia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_noticia')->textInput() ?>

    <?php  //$form->field($model, 'image_noticia')->textInput(['maxlength' => true]) ?>
   
    <?php /* <?= $form->field($model, 'ativo')->textInput() ?>*/?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
