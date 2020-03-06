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
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'corpo') ?>

    <?= $form->field($model, 'fonte_nm') ?>

    <?php // echo $form->field($model, 'fonte_url') ?>

    <?php // echo $form->field($model, 'dt_publicacao') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'dt_in') ?>

    <?php // echo $form->field($model, 'dt_up') ?>

    <?php // echo $form->field($model, 'logs') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
