<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\NewsAsset;
use yii\helpers\url;
use app\modules\admin\models\Category;
$category = Category::find()->all();
NewsAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangilik.uz</title>
    <?php $this->head() ?>
    
</head>

<body>
    <?php $this->beginBody() ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?=url::home()?>">Yangilik.uz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php foreach($category as $cat):?>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="<?=url::to(['news/category','id'=>$cat->id])?>"><?=$cat->catagory_name?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>



    <div class="container">
        <?=$content?>
    </div>


        </div>
    </div>


    <div class="card-footer text-muted sticky-bottom">
        <div class="container">
            <p class="float-left">
                <p class="float-left">&copy; My Company 2022</p>

        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
