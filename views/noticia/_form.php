<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_categoria')->DropdownList($categorias) ?>
    <!-- <?= $form->field($model, 'id_categoria')->textInput() ?> -->

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corpo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fonte_nm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fonte_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dt_publicacao')->input('date') ?>

    <?= $form->field($imagem, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php /* $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'dt_in')->textInput() ?>

    <?= $form->field($model, 'dt_up')->textInput() ?>

    <?= $form->field($model, 'logs')->textarea(['rows' => 6]) */?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
