<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

<!--    <div class="row">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
<!---->
<!--                --><?php //= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<!---->
<!--                --><?php //= $form->field($model, 'email') ?>
<!---->
<!--                --><?php //= $form->field($model, 'password')->passwordInput() ?>
<!---->
<!--                --><?php //= $form->field($model, 'photo_url')->fileInput() ?>
<!---->
<!--                <div class="form-group">-->
<!--                    --><?php //= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<!--                </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
    <div class="row">
        <div class="col-lg-5">
            <form id="form-signup">
                <div class="mb-3 field-signupform-username required">
                    <label class="form-label" for="signupform-username">Username</label>
                    <input type="text" id="signupform-username" class="form-control"
                           name="username" autofocus="" aria-required="true" aria-invalid="true">

                    <div class="invalid-feedback">Username cannot be blank.</div>
                </div>
                <div class="mb-3 field-signupform-email required">
                    <label class="form-label" for="signupform-email">Email</label>
                    <input type="text" id="signupform-email" class="form-control" name="email"
                           aria-required="true">

                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 field-signupform-password required">
                    <label class="form-label" for="signupform-password">Password</label>
                    <input type="password" id="signupform-password" class="form-control" name="password"
                           aria-required="true">

                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 field-signupform-photo_url">
                    <label class="form-label" for="signupform-photo_url">Photo Url</label>
                    <input type="hidden" name="photo_url" value=""><input type="file" id="signupform-photo_url" class="form-control" name="photo_url">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="signup-button">Signup</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    var $data = {};
    // переберём все элементы input, textarea и select формы с id="myForm "
    $('#form-signup').submit(function () {
        // $('#form-signup').find('input').each(function () {
        //     // добавим новое свойство к объекту $data
        //     // имя свойства – значение атрибута name элемента
        //     // значение свойства – значение свойство value элемента
        //     $data[this.name] = $(this).val();
        // });
        event.preventDefault();
        let that = $(this),
            data = new FormData(that.get(0));
        let formData = new FormData();
        formData.append('username', $('#signupform-username').val());
        formData.append('password', $('#signupform-password').val());
        formData.append('email', $('#signupform-email').val());
        formData.append('SignupForm[photo_url]', $('#signupform-photo_url')[0].files[0]);
        // console.log(data);
        $.ajax({
            url: 'http://yiitask2back:80/api/sign-up/signup',
            headers: {'Access-Control-Allow-Origin' : '*'},
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formData,
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            success: function(formData){
                alert("Complete registration using your E-mail");
                window.location.href = "http://yiitask2front:80/";
            }
        });
        return false
    });
</script>
