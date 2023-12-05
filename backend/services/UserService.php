<?php

namespace backend\services;
use backend\models\UserInfo;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UserService
{
    function updateById($id, $data)
    {
        $model = $this->getModel($id);
        if ($model->userInfo->birth_data == null) {
            $model->userInfo->birth_data = '';
        }

        if ($model->load($data, '') && $model->userInfo->load($data, '') && $model->userInfo->save() && $model->hashOnlyPassAndSave($model)) {
            return $model->toArray();
        }

        return array_merge($model->getErrors(), $model->userInfo->getErrors());
    }
    function createUser($data)
    {
        $model = new User();
        $userInfo = new UserInfo();

        if ($model->load($data, '') && $userInfo->load($data, '') && $model->save()) {
            $userInfo->auth_id = $model->id;
            $userInfo->save();
            return $model;
        }

        return array_merge($model->getErrors(), $userInfo->getErrors());


    }
    function activateUser($id)
    {
        $model = $this->getModel($id);

        $model->status = User::STATUS_ACTIVE;
        if ($model->save()) {
            return $model->toArray();
        }
        return array_merge($model->getErrors(), $model->userInfo->getErrors());
    }
    function banUser($id)
    {
        $model = $this->getModel($id);

        $model->status = User::STATUS_BANNED;
        if ($model->save()) {
            return $model->toArray();
        }


        return array_merge($model->getErrors(), $model->userInfo->getErrors());
    }

    function uploadUserPicture($id)
    {
        $model = $this->getModel($id);
        $userInfo = $model->userInfo;
        if (\Yii::$app->request->isPost) {
            $model->userInfo->eventImage = UploadedFile::getInstance($userInfo, 'photo_url');
            if ($model->userInfo->upload()) {
                return $model->toArray();

            }
        }

        return array_merge($model->getErrors(), $model->userInfo->getErrors());
    }

    private function getModel($id)
    {
        $model = User::findById($id);
        if (!$model) {
            throw new NotFoundHttpException('User does not exist.');
        }
        return $model;
    }
}