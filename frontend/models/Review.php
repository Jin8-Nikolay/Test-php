<?php

namespace frontend\models;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @Review class
 * @package frontend\models
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $date
 * @property User $author
 */
class Review extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    public function rules(): array
    {
        return [
            [['id', 'name', 'text', 'date'], 'trim'],
            ['id', 'integer'],
            [['name', 'text'], 'string'],
            ['date', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['author', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author' => 'id']],
        ];
    }

    public function getPk()
    {
        return $this->getPrimaryKey();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author']);
    }

    public function getUsername()
    {
        return $this->user->username;
    }
}