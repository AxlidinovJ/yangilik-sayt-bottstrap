<?php
use yii\helpers\Url;
 

$explode = explode('<img src="',$news->content);
if(isset($explode[1])){
    $explode2 = explode('" />',$explode[1]);
    $rasm2 = $images = $explode2[0];
}else{
    $rasm = $news->img;
}

?>

<div class="card mb-3">

    <?php if(!isset($rasm2) and $rasm): ?>
    <img src="<?=url::to("@web/newsimg/".$rasm)?>" class="card-img-top" alt="..." width="500">
    <?php endif;?>
    <div class="card-body">
        <h1 class="card-title"><?=$news->title?></h1>
        <div class="card-text"><?=str_replace("\n","",str_replace("<img src=","<img class='card-img-top' src=",$news->content))?></div>
        <p class="card-text text-end"><small class="text-muted"><?=$news->time?></small></p>
    </div>
</div>