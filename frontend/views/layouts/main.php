<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script
            src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
            crossorigin="anonymous">
    </script>
    <script
            src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js">
    Cookies.set('test','test');
    </script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
<script>
    if (Cookies.get('token') != undefined) {
        $('#w1').after('<a id="btn-logout" class="btn btn-link logout text-decoration-none" action="" href="">logout</a>');
        $('#w1').append('<li class="nav-item"><a class="nav-link" href="/user/index">User</a></li>');
    } else {
        $('#w1').after('<div class="d-flex"><a class="btn btn-link login text-decoration-none" href="/site/login">login</a></div>');
        $('#w1').append('<a class="nav-link" href="/site/signup">Signup</a>');
    }
    $(document).ready(function () {
        $(document).on('click', '#btn-logout', function () {
            $.ajax({
                url: 'http://yiitask2back:80/api/auth/logout',
                headers: {'Access-Control-Allow-Origin': '*'},
                method: 'POST',
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                success: function () {
                    Cookies.remove('token');
                    window.location.href = "/site/login";
                }
            })
            return false
        })
    });
</script>
</html>
<?php $this->endPage();
