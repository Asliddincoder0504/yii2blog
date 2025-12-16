<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $full_text
 * @property string|null $image
 * @property int $views
 * @property string $author
 * @property string $created_at
 * @property string|null $updated_at
 */
class Article extends \yii\db\ActiveRecord
{
    public $imageFile;
    


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'updated_at'], 'default', 'value' => null],
            [['views'], 'default', 'value' => 0],
            [['title', 'text', 'full_text', 'author', 'created_at'], 'required'],
            [['text', 'full_text'], 'string'],
            [['views'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'full_text' => 'Full Text',
            'image' => 'Image',
            'views' => 'Views',
            'author' => 'Author',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
