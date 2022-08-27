<?php

/* @var $review Review */


use frontend\models\Review;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $review->id;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => Url::to('/')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="manager-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $review,
        'attributes' => [
            'id',
            'name',
            'text',
            'date:datetime',
            'username',
        ]
    ]) ?>
</div>
