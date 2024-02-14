<?php

namespace backend\controllers\api;

use app\models\UserRefreshTokens;
use backend\models\UserInfo;
use common\models\LoginForm;
use common\models\User;
use backend\models\SignupForm;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\UploadedFile;
use backend\services\SignUpService;

class SignUpController extends ApiController
{

    private $service;

    public function __construct($id, $module, $config = [], SignUpService $service)
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'signup' => ['post'],
                ],
            ],
        ]);
    }
    public function actionSignup()
    {
        $this->service->actionSignup();
    }

}