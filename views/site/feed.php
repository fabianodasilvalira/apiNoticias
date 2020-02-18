<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="lead">Feed de Noticis via REST API.</d></h1>

    <?php  foreach($data as $roe)?>
    <p>Id: <?= $row['id'] ?></d>
    <p>Titulo: <?= $row['title'] ?></d>
    <p>Status: <?= $row['status'] ?></d>
      

    </div>
</div>
