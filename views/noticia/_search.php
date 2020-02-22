<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_noticias') ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'titulo_noticia') ?>

    <?= $form->field($model, 'descricao_noticia') ?>

    <?= $form->field($model, 'autor_noticia') ?>

    <?php // echo $form->field($model, 'data_noticia') ?>

    <?php // echo $form->field($model, 'image_noticia') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
