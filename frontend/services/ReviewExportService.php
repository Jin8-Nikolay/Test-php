<?php

namespace frontend\services;

use frontend\models\Review;
use frontend\repositories\ReviewRepository;
use yii\data\ArrayDataProvider;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ActiveDataProvider;

/**
 * @ReviewExportService class
 * @package frontend\services
 */
class ReviewExportService
{

    public function export(): \yii\web\Response
    {
        $exporter = (new Spreadsheet([
            'title' => 'Reviews',
            'dataProvider' => new ArrayDataProvider([
                'allModels' => ReviewRepository::getAllAsArrayWithUser(),
            ]),
            'columns' => [
                [
                    'attribute' => 'id',
                ],
                [
                    'attribute' => 'name',
                ],
                [
                    'attribute' => 'text',
                ],
                [
                    'attribute' => 'date',
                ],
                [
                    'attribute' => 'author',
                    'content' => function ($data) {
                       return $data['user']['username'];
                    },
                ],
            ],
        ]))->render();
        return $exporter->send('reviews.xlsx');
    }
}