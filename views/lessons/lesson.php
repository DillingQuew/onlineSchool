<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $lesson->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= $lesson->name?></h1>

    <p>
        <?= $lesson->description?>
    </p>
    <iframe width="560" height="315" src="<?=$lesson->videoUrl?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <p class=""><a class="btn btn-outline-success" href="<?= Url::toRoute(['lessons/done', 'id' =>$lesson->id])?>">Урок посмотрен</a></p>

</div>
