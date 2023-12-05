<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="user-form">

    <form id="w0" class="UploadPhotoForm" action="" method="post" enctype="multipart/form-data">
        <div class="mb-3 field-signupform-photo_url">
            <label class="form-label" for="signupform-photo_url">Photo Url</label>
            <input type="hidden" name="photo_url" value=""><input type="file" id="signupform-photo_url" class="form-control" name="UserInfo[photo_url]">

            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>    </div>

    </form>
</div>

<script>
    let data = {};
    $('.UploadPhotoForm').submit(function () {
        $('.UploadPhotoForm').find('input').each(function () {
            // добавим новое свойство к объекту $data
            // имя свойства – значение атрибута name элемента
            // значение свойства – значение свойство value элемента
            $data[this.name] = $(this).val();
        });
        let formData = new FormData();
        formData.append('UserInfo[photo_url]', $('#UserInfo[photo_url]')[0].files[0]);
        console.log(formData);
        let id = <?= Yii::$app->request->get('id') ?>;
            $.ajax({
                url: "http://yiitask2back:81/api/user/upload?id=" + id,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': 'Bearer ' + Cookies.get('token')
                },
                method: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType : 'json',
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                success: function (data) {
                    // console.log(data);
                    // window.location.href = "http://yiitask2front:81/user/view?id="+data.id;
                }
            })
        // })
        return false;
    })
</script>
