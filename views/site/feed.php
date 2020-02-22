<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="">
        <h1 class="">Feed de Noticis via REST API.</d></h1>

    <?php  foreach($data as $row) : ?>
    <p>Titulo: <?= $row['titulo_noticia'] ?></p>
    <p>Noticia: <?= $row['descricao_noticia'] ?></p>
    <p>Autor: <?= $row['autor_noticia'] ?></p>
      
    <?php endforeach; ?>

    </div>
</div>
