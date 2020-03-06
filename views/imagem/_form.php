<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fonte_nm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fonte_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objeto')->textInput() ?>

    <?= $form->field($model, 'id_objeto')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'dt_in')->textInput() ?>

    <?= $form->field($model, 'dt_up')->textInput() ?>

    <?= $form->field($model, 'logs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
