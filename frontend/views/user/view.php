<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\UrlManager;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Profile Image', ['upload', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
<script>
let id =<?= Yii::$app->request->get('id') ?>;
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
        success: function(data) {
            $('.user-view').append('<table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>Profile photo</th><td><img id="DynamicImage" src="http://yiitask2back:81/images/'+data.userInfo.photo_url+'" width="100" height="100" alt=""></td></tr><tr><th>ID</th><td>'+data.id+'</td></tr><tr><th>Username</th><td>'+data.username+'</td></tr><tr><th>Email</th><td><a href="mailto:"+data.email+">'+data.email+'</a></td></tr><tr><th>Status</th><td>'+data.status+'</td></tr><tr><th>Created At</th><td>'+data.created_at+'</td></tr><tr><th>Updated At</th><td>'+data.updated_at+'</td></tr><tr><th>Surname</th><td>'+data.userInfo.surname+'</td></tr><tr><th>Name</th><td>'+data.userInfo.name+'</td></tr><tr><th>Patronymic</th><td>'+data.userInfo.patronymic+'</td></tr><tr><th>iin</th><td>'+data.userInfo.iin+'</td></tr><tr><th>Date of birth</th><td>'+data.userInfo.birth_data+'</td></tr></tbody></table>');
        }});
</script>
