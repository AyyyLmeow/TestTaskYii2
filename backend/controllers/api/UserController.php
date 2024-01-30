<?php

namespace backend\controllers\api;

use backend\models\UserInfo;
use backend\services\UserService;
use common\models\user;
use http\Url;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\Action;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\data\Pagination;

class UserController extends \yii\rest\ActiveController
{

    public $enableCsrfValidation = false;
    public $modelClass = 'common\models\User';
    private $service;

    public function __construct($id, $module, $config = [], UserService $service)
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['http://yiitask2front:81/'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600 * 7,                 // Cache (seconds)
                ],
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['create', 'view', 'index', 'user'],
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
            'authenticator' => [
                'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
                'optional' => ['login','logout', 'sign-up'],
            ],
        ]);
    }

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['update'] = ['PUT', 'PATCH', 'OPTIONS', 'POST',];
        $verbs['create'] = ['POST', 'OPTIONS'];
        $verbs['upload'] = ['PUT', 'PATCH', 'OPTIONS', 'POST',];
        return $verbs;
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $user = \Yii::$app->user->identity;
//        $request = \Yii::$app->request;
//        $roles = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->getId());
//        $role = \Yii::$app->user->can('admin');
        \Yii::$app->response->format = Response::FORMAT_JSON;

        if (\Yii::$app->user->can('admin')) {
            return true;
        }

        if (in_array($action->id, ['index', 'view', 'update', 'upload']) && \Yii::$app->user->can('baseUser')){
            if ($action->id != 'index' && $_GET['id'] == $user->id) {
                return true;
            }else{
                throw new ForbiddenHttpException('Access denied');
            }
        }
        if (\Yii::$app->user->can($action->id)) {
            return true;
        }

        throw new ForbiddenHttpException('Access denied');
    }

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "update" и "create"
        unset($actions['update'], $actions['create'], $actions['index']);


        return $actions;
    }

    public function actionUpdate()
    {
        return $this->service->updateById($this->request->get('id'), $this->request->post());
    }

    public function actionCreate()
    {
        return $this->service->createUser($this->request->post());
    }

    public function actionActivate()
    {
        return $this->service->activateUser($this->request->get('id'));

    }

    public function actionBan()
    {
        return $this->service->banUser($this->request->get('id'));
    }


    public function actionUpload()
    {
        return $this->service->uploadUserPicture($this->request->get('id'));

    }

    function actionIndex()
    {
        $query = User::find();
        // Добавляем параметры сортировки
        $sortAttribute = \Yii::$app->request->get('sort', ''); // Получаем параметр сортировки из запроса
        $sortOrder = \Yii::$app->request->get('order', 'asc'); // Получаем параметр направления сортировки из запроса

        if ($sortAttribute) {
            $sort = [$sortAttribute => ($sortOrder === 'asc' ? SORT_DESC : SORT_ASC)];
            // Добавляем сортировку в запрос
            $query->orderBy($sort);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        // Создаем массив данных для ответа
        $response = [
            'models' => $models,
            'pages' => [
                'totalCount' => $pages->totalCount,
                'pageCount' => $pages->getPageCount(),
                'currentPage' => $pages->getPage() + 1, // Текущая страница начинается с 0, поэтому добавляем 1
                'pageSize' => $pages->getPageSize(),
            ],
        ];

        return $response; // Yii2 автоматически преобразует массив в формат JSON
    }
}