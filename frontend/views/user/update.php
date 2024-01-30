<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<script>
    let id = <?= $_GET['id'] ?? 'undefined'; ?>;
        $.ajax({
            url: "http://yiitask2back:80/api/users/" + id,
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': 'Bearer ' + Cookies.get('token')
            },
            method: 'get',
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            success: function (data) {
                $('#user-form').find('input').each(function () {
                    if(data[this.name] == undefined){
                        $(this).val(data.userInfo[this.name]);
                    } else {
                        $(this).val(data[this.name]);
                    }
                });
            }
        })

    var $data = {};
    // переберём все элементы input с id="user-form "
    $('#user-form').submit(function () {
        $('#user-form').find('input').each(function () {
            // добавим новое свойство к объекту $data
            // имя свойства – значение атрибута name элемента
            // значение свойства – значение свойство value элемента
            $data[this.name] = $(this).val();
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
        $.ajax({
            url: 'http://yiitask2back:80/api/user/update?id=' + id,
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': 'Bearer ' + Cookies.get('token')
            },
            method: 'POST',
            dataType: 'json',
            data: $data,
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            success: function (data) {
                window.location.href = "http://yiitask2front:80/user/view?id=" + id;
            }
        });
        return false
    });
</script>