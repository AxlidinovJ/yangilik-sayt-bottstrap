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

function ImgagesFind($datas){
    $explode = explode('<img src="',$datas);
    if(isset($explode[1])){
        $explode2 = explode('" />',$explode[1]);
        $images = $explode2[0];
        return $images;
    }else{
        return false;
    }
}


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
                    if(empty($data->img)){
                        $rasm = ImgagesFind($data->content)?:"@web/newsimg/no-img.jpg";
                    }else{
                        $rasm = "@web/newsimg/".$data->img;
                    }
                    return html::img($rasm,['width'=>'200px']);
                }
            ],
            // 'content:ntext',
            // [
            //     'attribute'=>"content",
            //     // 'format'=>'html',
            //     'value'=>function($data){
            //          $malumot = substr($data->content,0,100);
            //          return $malumot;
            //     }
            // ],
            //'author',
            //'time',
            // 'status',
            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>function($data){
                    return html::a($data->status?"<span class='text-success'>True</span>":"<span class='text-danger'>False</span>",['news/status','id'=>$data->id]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template'=>"{view} {delete} {update}",
                'buttons'=>[
                    'delete'=>function($url,$data){
                        return html::a("<i class='bi-person-x'bi-></i>",["news/delete",'id'=>$data->id]);
                    }
                ],
            ],
        ],
        
    ]); ?>


</div>
