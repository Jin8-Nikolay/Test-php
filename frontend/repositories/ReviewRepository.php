<?php

namespace frontend\repositories;

use frontend\models\Review;

/**
 * @ReviewsRepository class
 * @package frontend\repositories
 */
class ReviewRepository
{
    public static function getAllAsArrayWithUser(): array
    {
        return Review::find()
            ->joinWith('user')
            ->asArray()
            ->all();
    }

    public static function getById(int $id)
    {
        return Review::find()->where(['id' => $id])->one();
    }

    public static function getByAuthor(int $authorId): array
    {
        return Review::find()->where(['author' => $authorId])->all();
    }

    public static function getByLatestDate()
    {
        return Review::find()->orderBy('date DESC')->limit(1)->one();
    }

    public static function getByFirstDate()
    {
        return Review::find()->orderBy('date ASC')->limit(1)->one();
    }
}