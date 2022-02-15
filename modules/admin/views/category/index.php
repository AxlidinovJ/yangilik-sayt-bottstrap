<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'catagory_name',
            'date',
            [
                'class' => ActionColumn::className(),
                'template'=>"{view} {delete} {update}",
                'buttons'=>[
                    'delete'=>function($url,$data){
                        return html::a("<i class='bi-person-x'bi-></i>",["category/delete",'id'=>$data->id]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
