<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<form id="user-form" method = "post">
    <div class="form-group field-user-username required"><label class="control-label"
                                                                for="user-username">Username</label>
        <input type="text" id="user-username" class="form-control" name="username" value="" aria-required="true">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-user-auth_key"><label class="control-label" for="user-auth_key">Auth Key</label> <input
                type="text" id="user-auth_key" class="form-control" name="auth_key" value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-user-password_hash required"><label class="control-label" for="user-password_hash">Password
            Hash</label><input type="text" id="user-password_hash" class="form-control" name="password_hash" value=""
                               aria-required="true">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-user-password_reset_token"><label class="control-label"
                                                                   for="user-password_reset_token">Password
            Reset Token</label><input type="text" id="user-password_reset_token" class="form-control"
                                      name="password_reset_token" value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-user-email required"><label class="control-label" for="user-email">Email</label><input
                type="text" id="user-email" class="form-control" name="email" value="" aria-required="true">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-userinfo-surname"><label class="control-label"
                                                          for="userinfo-surname">Surname</label><input
                type="text" id="userinfo-surname" class="form-control" name="surname" value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-userinfo-name"><label class="control-label" for="userinfo-name">Name</label><input
                type="text" id="userinfo-name" class="form-control" name="name" value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-userinfo-patronymic"><label class="control-label"
                                                             for="userinfo-patronymic">Patronymic</label><input
                type="text"
                id="userinfo-patronymic"
                class="form-control"
                name="patronymic"
                value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-userinfo-iin"><label class="control-label" for="userinfo-iin">Iin</label><input
                type="text"
                id="userinfo-iin"
                class="form-control"
                name="iin"
                value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group field-userinfo-birth_data"><label class="control-label" for="userinfo-birth_data">Birth
            Data</label><input type="date" id="userinfo-birth_data" class="form-control" name="birth_data" value="">
        <div class="help-block"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>

