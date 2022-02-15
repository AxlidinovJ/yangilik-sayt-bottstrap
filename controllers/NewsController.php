<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\News;
use yii\data\Pagination;
class NewsController extends Controller
{
    public function actionIndex()
    {
        $query = News::find()->andwhere(['status' => 1]);
        $pagination = new Pagination([
            'totalCount'=>$query->Count(),
            'defaultPageSize'=>6,
        ]);
        $news = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['news'=>$news,'pagination'=>$pagination]);
    }

    public function actionView($id)
    {
        $news = News::findOne($id);
        if($news->status==1){
            return $this->render('view',['news'=>$news]);
        }else{
            return $this->redirect(['site/error']);
        }
    }

    public function actionCategory($id)
    {
        $query = News::find()->where(['catagory_id' => $id])->andwhere(['status' => 1]);
        if(count($query->all())){
            $pagination = new Pagination([
                'totalCount'=>$query->Count(),
                'defaultPageSize'=>6,
            ]);
            $news = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('index',['news'=>$news,'pagination'=>$pagination]);
        }else{
            return $this->redirect(['site/error']);
        }
    }


    public function actionSearch($search)
    {
        $query = News::find()->where(['like','title',$search])->andwhere(['status' => 1]);
        if(count($query->all())){
            $pagination = new Pagination([
                'totalCount'=>$query->Count(),
                'defaultPageSize'=>6,
            ]);
            $news = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('index',['news'=>$news,'pagination'=>$pagination]);
        }else{
            return $this->redirect(['site/error']);
        }
    }


}
