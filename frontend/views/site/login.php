<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>Login</h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <form id="login-form" method="post">
                <input type="hidden" name="_csrf-frontend" value="E4tL8fuSwkrnvKndBOUnHLe8petuErDGvRQqRnusTHpW0j_Ew6CyJKzJzYdp0Up78dXOgS9R46L7cBkBFJ45OQ==">
                <div class="mb-3 field-loginform-username required">
                    <label class="form-label" for="loginform-username">Username</label>
                    <input type="text" id="loginform-username" class="form-control" name="username" autofocus="" aria-required="true">

                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3 field-loginform-password required">
                    <label class="form-label" for="loginform-password">Password</label>
                    <input type="password" id="loginform-password" class="form-control" name="password" value="" aria-required="true">

                    <div class="invalid-feedback"></div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="login-button">Login</button>                </div>

            </form>        </div>
    </div>

</div>
<script>
    var $data = {};
    // переберём все элементы input, textarea и select формы с id="myForm "
    $('#login-form').submit(function () {
        $('#login-form').find('input').each(function () {
            // добавим новое свойство к объекту $data
            // имя свойства – значение атрибута name элемента
            // значение свойства – значение свойство value элемента
            $data[this.name] = $(this).val();
        });
        console.log($data);
        $.ajax({
            url: 'http://yiitask2back:80/api/auth/login',
            headers: {'Access-Control-Allow-Origin' : '*'},
            method: 'post',
            dataType: 'json',
            data: $data,
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            success: function(data){
                Cookies.set('token', data.token);
                window.location.href = "http://yiitask2front:80/";
            }
        });
        return false
    });

</script>



