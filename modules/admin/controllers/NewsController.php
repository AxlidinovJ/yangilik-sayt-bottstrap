<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\News;
use app\modules\admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\web\UploadedFile;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST','GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all News models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new News();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->time = date('Y-m-d H:i:s');
                $rasm  = UploadedFile::getInstance($model,'img');
                if(isset($rasm)){              
                    $random = new Security();
                    $name = $random->generateRandomString(10).".".$rasm->extension;
                    $rasm->saveAs("newsimg/".$name);
                    $model->img = $name;
                }
                $model->author = \Yii::$app->user->identity->username;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $name = $model->img;
        if ($this->request->isPost && $model->load($this->request->post()) ) {
                $rasm  = UploadedFile::getInstance($model,'img');  
                if(!empty($rasm)){   
                    unlink("newsimg/".$name);      
                    $random = new Security();
                    $name = $random->generateRandomString(10).".".$rasm->extension;
                    $rasm->saveAs("newsimg/".$name);
                }
                $model->img = $name;
                $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(file_exists("./newsimg/".$model->img?$model->img:"")){
            unlink("./newsimg/".$model->img?$model->img:"");
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStatus($id){
        $model = $this->findModel($id);
        $model->status = $model->status?"0":"1";
        $model->save();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionChiqish()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

}
