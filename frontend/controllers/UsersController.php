<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\forms\CreateManagerForm;
use frontend\models\UserSearch;
use frontend\repositories\ReviewRepository;
use frontend\repositories\UserRepository;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * User controller
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create-user'],
                'rules' => [
                    [
                        'actions' => ['create-user'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            /** @var User $user */
                            $user = Yii::$app->user->getIdentity();
                            return $user->isAdmin();
                        }
                    ],
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
        $searchModel = Yii::$container->get(UserSearch::class);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users', compact('dataProvider', 'searchModel'));
    }

    /**
     * Create user with role manager.
     *
     * @return mixed
     */
    public function actionCreateUser()
    {
        $model = Yii::$container->get(CreateManagerForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Manager successfully created.');
            return $this->redirect('/users');
        }

        return $this->render('create-user', [
            'model' => $model,
        ]);
    }

    /**
     * Displays create review page.
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $user = $this->findUser($id);

        return $this->render('view-user', compact('user'));
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $user = $this->findUser($id);

        $reviews = ReviewRepository::getByAuthor($id);

        foreach ($reviews as $review) {

            $review->delete();
        }
        $user->delete();

        return $this->redirect(Url::to('/users'));
    }

    /**
     * @param int $id
     * @return array|User
     * @throws NotFoundHttpException
     */
    private function findUser(int $id)
    {
        $user = UserRepository::getById($id);

        if (empty($user)) {

            throw new NotFoundHttpException('User by id = ' . $id . ' not found');
        }
        return $user;
    }
}
