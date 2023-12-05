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

class SignUpController extends ApiController
{

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
//            'access' => [
//                'class' => AccessControl::class,
//                'only' => ['signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'signup' => ['post'],
                ],
            ],
//            'jwtAuth' => [
//                'class' => JwtHttpBearerAuth::class,
//                'optional' => ['signup','index'], // Указываем, какие действия не требуют аутентификации
//            ],
        ]);
    }
    public function actionSignup()
    {
        $model = new SignupForm();
        $model->password = Yii::$app->request->post('password');
        $model->username = Yii::$app->request->post('username');
        $model->email = Yii::$app->request->post('email');
        $model->eventImage = UploadedFile::getInstance($model, 'photo_url');
//        $notfunny1 = $model->validate();
//        $notfunny2 = $model->signup();
        if ($model->validate() && $model->signup()) {
            return true;
        };
        return $model->getErrors();
    }

}