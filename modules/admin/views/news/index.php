<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'catagory_id',
            [
                'attribute'=>'catagory_id',
                'value'=>function($data){
                    return $data->catagory->catagory_name;
                }
            ],
            'title',
            // 'img',
            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>function($data){
                    return html::img("@web/newsimg/".$data->img,['width'=>'200px']);
                }
            ],
            // 'content:ntext',
            [
                'attribute'=>"content",
                'value'=>function($data){
                    return substr($data->content,0,100);
                }
            ],
            //'author',
            //'time',
            //'status',
            [
                'class' => ActionColumn::className(),
                // 'urlCreator' => function ($action, News $model, $key, $index, $column) {
                //     return Url::toRoute([$action, 'id' => $model->id]);
                //  }
            ],
        ],
    ]); ?>


</div>
