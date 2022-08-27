<?php

namespace frontend\viewModels;

use frontend\models\forms\ReviewForm;
use frontend\models\ReviewSearch;
use frontend\repositories\ReviewRepository;
use Yii;

/**
 * @ReviewsViewModel class
 * @package frontend\viewModels
 */
class ReviewsViewModel
{
    private ReviewSearch $searchModel;

    public function __construct(ReviewSearch $searchModel)
    {
        $this->searchModel = $searchModel;
    }

    public function getSearchModel(): ReviewSearch
    {
        return $this->searchModel;
    }

    public function getDataProvider(): \yii\data\ActiveDataProvider
    {
        return $this->searchModel->search(\Yii::$app->request->queryParams);
    }

    public function getDateFrom()
    {
        if (isset(Yii::$app->request->queryParams['date_from'])) {

            return Yii::$app->request->queryParams['date_from'];
        }

        $firstReview = ReviewRepository::getByFirstDate();
        $date = date_create($firstReview->date);
        return date_format($date, 'Y-m-d');
    }

    public function getDateTo()
    {
        if (isset(Yii::$app->request->queryParams['date_to'])) {

            return Yii::$app->request->queryParams['date_to'];
        }

        $latestReview = ReviewRepository::getByLatestDate();
        $date = date_create($latestReview->date);
        $date->modify('+1 day');
        return date_format($date, 'Y-m-d');
    }
}