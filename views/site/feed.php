<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name . " - Feed";
?>
<div class="site-index">

    <div class="">
        <h1 class="">Feed de Notícias via REST API.</d></h1>

        <?php foreach($data as $row) : ?>
            <p>Titulo: <?= $row['titulo'] ?></p>
            <p>Noticia: <?= $row['corpo'] ?></p>
            <p>Autor: <?= $row['fonte_nm'] ?></p>     
        <?php endforeach; ?>

    </div>
</div>
