<?php
namespace frontend\viewModels;

use frontend\models\forms\ReviewForm;

/**
 * @CreateReviewViewModel class
 * @package frontend\viewModels
 */
class CreateReviewViewModel
{
    private ReviewForm $form;

    public function __construct(ReviewForm $form)
    {
        $this->form = $form;
    }

    public function getForm(): ReviewForm
    {
        return $this->form;
    }

    public function getAuthors()
    {
        return \yii\helpers\ArrayHelper::map(\frontend\repositories\UserRepository::getAll(), 'id', 'username');
    }
}