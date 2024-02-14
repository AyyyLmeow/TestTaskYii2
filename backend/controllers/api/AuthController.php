<?php

namespace backend\controllers\api;

use app\models\UserRefreshTokens;
use common\models\LoginForm;
use common\models\User;
use Yii;
use backend\services\AuthService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class AuthController extends ApiController
{
    public $enableCsrfValidation = false;

    private $service;

    public function __construct($id, $module, $config = [], AuthService $service)
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ]);
    }

    public function actionLogin()
    {
       return $this->service->login();
    }
    public function actionLogout()
    {
        return $this->service->logout($this->getUser());
    }

}