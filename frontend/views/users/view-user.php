<?php

/* @var $user \common\models\User */


use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => Url::to('/users')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="manager-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            'username',
            'email',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->getRoleName($model->role);
                }
            ],
        ]
    ]) ?>
</div>
