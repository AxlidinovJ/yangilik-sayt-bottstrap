<?php

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Category;
use dosamigos\tinymce\TinyMce;

$cat = Category::find()->all();
$category = ArrayHelper::map($cat,'id','catagory_name');

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catagory_id')->dropDownList($category,['prompt'=>"Categoriyani tanlang"]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <?= $form->field($model, 'content')->widget(TinyMce::className(), [
    'options' => ['rows' => 20],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>"Yoqish",'0'=>"O'chirish"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
