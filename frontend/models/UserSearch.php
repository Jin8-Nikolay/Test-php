<?php

namespace frontend\models;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\debug\models\search\UserSearchInterface;

/**
 * @UserSearch class
 * @package frontend\models
 */
class UserSearch extends User implements UserSearchInterface
{

    public function rules(): array
    {
        return [
            [['email', 'username'], 'trim'],
            [['email', 'username'], 'string', 'max' => 254],
            ['role', 'integer'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $this->load($params);

        if (!($this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['role' => $this->role])
            ->andFilterWhere(['like', 'username', $this->email])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}