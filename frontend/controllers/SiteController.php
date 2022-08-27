<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\forms\ReviewForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\Review;
use frontend\models\ReviewSearch;
use frontend\models\VerifyEmailForm;
use frontend\repositories\ReviewRepository;
use frontend\services\ReviewExportService;
use frontend\viewModels\CreateReviewViewModel;
use frontend\viewModels\ReviewsViewModel;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'create-manager', 'create-review'],
                'rules' => [
                    [
                        'actions' => ['create-manager', 'create-review'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            /** @var User $user */
                            $user = Yii::$app->user->getIdentity();
                            return $user->isAdmin();
                        }
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $viewModel = Yii::$container->get(ReviewsViewModel::class);

        return $this->render('reviews', compact('viewModel',));
    }

    /**
     * Displays create review page.
     *
     * @return mixed
     */
    public function actionCreateReview()
    {
        $viewModel = Yii::$container->get(CreateReviewViewModel::class);
        if (Yii::$app->request->isPost) {

            $form = Yii::$container->get(ReviewForm::class);
            if ($form->load(Yii::$app->request->post()) && $form->save()) {
                Yii::$app->session->setFlash('success', 'Review has been created.');
                return $this->goHome();
            }

            $this->render('create-review', compact('viewModel'));
        }

        return $this->render('create-review', compact('viewModel'));
    }

    /**
     * Displays create review page.
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $review = $this->findReview($id);

        return $this->render('view-review', compact('review'));
    }

    /**
     * @return Response
     * @throws \Throwable
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteReview($id): Response
    {
        $review = $this->findReview($id);

        $review->delete();
        return $this->redirect(Url::home());
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionExport(): \yii\web\Response
    {
        $service = Yii::$container->get(ReviewExportService::class);

        return $service->export();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @param int $id
     * @return array|Review
     * @throws NotFoundHttpException
     */
    private function findReview(int $id)
    {
        $user = ReviewRepository::getById($id);

        if (empty($user)) {

            throw new NotFoundHttpException('Review by id = ' . $id . ' not found.');
        }
        return $user;
    }
}
