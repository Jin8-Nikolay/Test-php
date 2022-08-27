<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;

/**
 * @ReviewSearch class
 * @package frontend\models
 */
class ReviewSearch extends Review
{
    public $username;

    public function rules(): array
    {
        return [
            [['date', 'name', 'username'], 'trim'],
            [['name', 'username'], 'string', 'max' => 254],
            ['date', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Review::find();

        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['username' => SORT_ASC],
            'desc' => ['username' => SORT_DESC],
        ];

        $this->load($params);

        if (!($this->validate())) {
            return $dataProvider;
        }

        $dateFrom = isset($params['date_from']) ? $params['date_from'] : '';
        $dateTo = isset($params['date_to']) ? $params['date_to'] : '';

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['between', 'date', $dateFrom, $dateTo])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}