<?php
use yii\helpers\Url;
?>

<div class="card mb-3">
    <img src="<?=url::to("@web/newsimg/".$news->img)?>" class="card-img-top" alt="..." width="500">
    <div class="card-body">
        <h5 class="card-title"><?=$news->title?></h5>
        <p class="card-text"><?=str_replace("\n","<br>",$news->content)?></p>
        <p class="card-text text-end"><small class="text-muted"><?=$news->time?></small></p>
    </div>
</div>