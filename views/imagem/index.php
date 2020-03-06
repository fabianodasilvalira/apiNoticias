<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Imagem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'path',
            'titulo',
            'descricao',
            'fonte_nm',
            //'fonte_url:url',
            //'objeto',
            //'id_objeto',
            //'id_user',
            //'status',
            //'dt_in',
            //'dt_up',
            //'logs:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
