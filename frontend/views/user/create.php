<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var \backend\models\UserInfo $userInfo */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userInfo' => $userInfo,
    ]) ?>

</div>

<script>
    let data = {};
    // переберём все элементы input, textarea и select формы с id="myForm "
    $('#user-form').submit(function () {
        $('#user-form').find('input').each(function () {

            // добавим новое свойство к объекту $data
            // имя свойства – значение атрибута name элемента
            // значение свойства – значение свойство value элемента
            data[this.name] = $(this).val();
        });
        if (!$('#user-username').val()) {
            alert('Enter your username!');
        }
        if (!$('#user-password_hash').val()) {
            alert('Password cannot be blank!');
        }
        if (!$('#user-email').val()) {
            alert('Enter your email');
        }
        console.log(data);
        $.ajax({
            url: 'http://yiitask2back:80/api/user/create',
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': 'Bearer ' + Cookies.get('token')
            },
            method: 'POST',
            dataType: 'json',
            data: data,
            error: function (request, error) {
                alert(" Can't do because: " + error);
            },
            success: function (data) {
                console.log(data)
                window.location.href = "http://yiitask2front:80/user/view?id=" + id;
            }
        });
        return false
    });
</script>
