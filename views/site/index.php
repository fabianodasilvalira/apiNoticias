<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Noticias';
// $this->params['breadcrumbs'][] = $this->title;

// // echo "<pre>";
// // var_dump($model);
// foreach ($model as $n) {
//     echo "<pre>";
//     var_dump($n->imagem->nome);
//     echo "</pre>";
// }
// die;
?>
<div class="site-index">
    <div class="row">
        <?php foreach ($model as $noticia): ?>
            <div class="col-md-12">
                <h1 style="text-align: center;"><?= $noticia->titulo ?></h1>
                <div class="row" style="margin: 10px 0;">
                    <!-- <div> -->
                        <div class="col-md-4"><?= $noticia->categoria->nome ?></div>
                        <div class="col-md-4 text-center"><?= $noticia->user->username ?></div>
                        <div class="col-md-4 text-right"><?= $noticia->dt_publicacao ?></div>
                    <!-- </div> -->
                </div>
                <div style="text-align: justify;">
                    <img src="<?= $noticia->imagem->path . $noticia->imagem->nome ?>" height="200" style="float:left; margin: 0 10px 10px 0">
                    
                    <?= $noticia->corpo ?>
                </div>
                <div>
                    <p><?= $noticia->fonte_nm ?></p>
                    <p><?= $noticia->fonte_url ?></p>
                </div>
            </div>
            <hr>
        <?php endforeach ?>
    </div>

    <!-- <div class="jumbotron">
        <h1>Bem-vindo!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
