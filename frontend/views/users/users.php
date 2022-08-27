<?php

/**
 * @var yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \frontend\models\ReviewSearch $searchModel
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Users';
?>
<?php if (Yii::$app->user->getIdentity()->isAdmin()) : ?>
    <?= Html::a('Create User', [Url::to('create-user')], ['class' => 'btn btn-success mb-3']) ?>
<?php endif; ?>


<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        'id',
        'username',
        'email',
        [
            'attribute' => 'role',
            'value' => function ($model) {
                return $model->getRoleName($model->role);
            },
            'filter' => \common\models\User::roles(),
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}'
        ],
    ],
]) ?>
