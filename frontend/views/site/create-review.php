<?php

/**
 * @var yii\web\View $this
 * @var CreateReviewViewModel $viewModel
 */

use frontend\viewModels\CreateReviewViewModel;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$this->title = 'Create Review';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="p-md-3">
        <?= $form->field($viewModel->getForm(), 'name')->textInput() ?>
    </div>

    <div class="p-md-3">
        <?= $form->field($viewModel->getForm(), 'text')->textarea() ?>
    </div>

    <div class="p-md-3">
        <?= $form->field($viewModel->getForm(), 'author')->widget(Select2::class, [
            'data' => $viewModel->getAuthors(),
            'options' => [
                'placeholder' => 'Select author ...',
            ],
        ]) ?>
    </div>
</div>

<?= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
