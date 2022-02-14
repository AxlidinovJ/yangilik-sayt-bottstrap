<?php
use yii\helpers\Url;

?>
<div class="row row-cols-1 row-cols-md-3 g-4">
   <?php foreach($news as $new):?> 
    <div class="col">
        <div class="card h-100">
            <img src="<?=url::to('@web/newsimg/'.$new->img)?>" class="card-img-top" alt="rasm">
            <div class="card-body">
                <h5 class="card-title"><?=$new->title?>...</h5>
                <a href="<?=url::to(['news/view','id'=>$new->id])?>" class="btn btn-success">Yangilikni o'qish</a>
                <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
            </div>
        </div>
    </div>
    <?php endforeach;?>
 </div>
