<?php

namespace frontend\models\forms;

use frontend\models\Review;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @ReviewForm class
 * @package frontend\models\forms
 */
class ReviewForm extends Model
{
    public $name;
    public $text;
    public $author;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'author'], 'required'],

            ['name', 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['text', 'trim'],
            ['text', 'string', 'max' => 1000],
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $review = new Review();
        $review->name = $this->name;
        $review->text = $this->text;
        $review->date = date('Y-m-d H:i:s');
        $review->author = $this->author;

        return $review->save();
    }
}