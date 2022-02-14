<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $catagory_id
 * @property string $title
 * @property string $img
 * @property string $content
 * @property string $author
 * @property string $time
 * @property int $status
 *
 * @property Category $catagory
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catagory_id', 'title', 'img', 'content','status'], 'required'],
            [['catagory_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['time'], 'safe'],
            [['title', 'img', 'author'], 'string', 'max' => 255],
            [['catagory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['catagory_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catagory_id' => 'Catagory ID',
            'title' => 'Title',
            'img' => 'Img',
            'content' => 'Content',
            'author' => 'Author',
            'time' => 'Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Catagory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatagory()
    {
        return $this->hasOne(Category::className(), ['id' => 'catagory_id']);
    }
}
