<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\News;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $news = News::find()->all();
        return $this->render('index',['news'=>$news]);
    }

    public function actionView($id)
    {
        $news = News::findOne($id);
        return $this->render('view',['news'=>$news]);
    }

    public function actionCategory($id)
    {
        $news = News::find()->where(['catagory_id' => $id])->all();
        return $this->render('index',['news'=>$news]);
    }
}
