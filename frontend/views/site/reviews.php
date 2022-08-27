<?php

/**
 * @var yii\web\View $this
 * @var ReviewsViewModel $viewModel
 */

use frontend\viewModels\ReviewsViewModel;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Reviews';
?>
<?php if (Yii::$app->user->getIdentity()->isAdmin()) : ?>

    <?= Html::a('Create Review', [Url::to('create-review')], ['class' => 'btn btn-success mb-3']) ?>
<?php endif; ?>

<?= Html::a('Export to Excel', [Url::to('export')], ['class' => 'btn btn-success mb-3']) ?>

<?= GridView::widget([
    'dataProvider' => $viewModel->getDataProvider(),
    'filterModel' => $viewModel->getSearchModel(),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'name',
        [
            'attribute' => 'date',
            'filter' => DatePicker::widget([

                'name' => 'date_from',
                'value' => $viewModel->getDateFrom(),
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'date_to',
                'value2' => $viewModel->getDateTo(),
                'separator' => '<i class="fas fa-arrows-alt-h"></i>',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]),
        ],
        'date:datetime',
        'username',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}',
        ],
    ],
]) ?>
