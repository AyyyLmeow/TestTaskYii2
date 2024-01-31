<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use \yii\data\Pagination;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

//$page = new Pagination(['totalCount' => User::find()->count()]);
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>

    </p>


    <div id="w0" class="grid-view">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th><a href="#" id="sort-id" data-sort="id" data-order="asc">ID</a></th>
                <th><a href="/user/index?sort=username" id="sort-user" data-sort="username">Username</a></th>
                <th>Email</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="action-column">&nbsp;Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a href="#" id="prev-page" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a href="#" id="next-page" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script>
    let datasPages = {currentPage: 1, totalCount : 0,
            pageCount : 0, pageSize : 10};
    function loadData(page, sort, order) {
        $.ajax({
            url: 'http://yiitask2back:80/api/users?page=' + page,
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': 'Bearer ' + Cookies.get('token')
            },
            method: 'get',
            data: {
                page: page,
                sort: sort,
                order: order // передаю параметр направления сортировки
            },
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            success: function (data) {
                $('tbody').empty();
                datasPages = data.pages;
                $.each(data.models, function (index, value) {
                    $('tbody').append('<tr ' + 'data-key=' + value.id + '><td>"' + (index + 1) + '"</td><td>' + value.id + '</td><td>' + value.username + '</td><td>' + value.email + '</td><td>' + value.status + '</td><td>' + value.created_at + '</td><td><a href="/user/view?id=' + value.id + '" title="View" aria-label="View" data-pjax="0"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg></a> <a href="/user/update?id=' + value.id + '" title="Update" aria-label="Update" data-pjax="0"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path></svg></a> <a href="/user/delete?id=' + value.id + '" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg></a><a href="#" data-key=' + value.id + ' class="item-activate" title="Activate" aria-label="Activate"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/></svg></a><a href="#" data-key=' + value.id + ' class="item-ban" title="Ban" aria-label="Ban"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg></a></td></tr>');
                })
            }
        })


    }
    $(window).on('load', function (){
        loadData()
    })

    $(document).ready(function () {
        $(document).on('click', '#sort-id', function() {
            {
                let currentSort = $(this).data('sort'); // Устанавливаем поле сортировки по умолчанию
                let currentOrder = $(this).data('order');// Устанавливаем порядок сортировки по умолчанию

                // Меняем порядок сортировки
                $(this).data('order', (currentOrder === 'asc') ? 'desc' : 'asc');

                // Вызываем функцию loadData с актуальными параметрами сортировки и направления
                loadData(datasPages.currentPage, currentSort, currentOrder);
            }
        });
        // Обработка клика на кнопке "Next" для перехода на следующую страницу
        $(document).on('click', '#next-page', function() {
            let currentPage = datasPages.currentPage;
            if (currentPage < datasPages.pageCount) {
                loadData(currentPage + 1);
            }
            else{
                console.log('nope');
            }
        });


        // Обработка клика на кнопке "Previous" для перехода на предыдущую страницу
        $(document).on('click', '#prev-page', function() {
            let currentPage = datasPages.currentPage;
            if (currentPage > 1) {
                loadData(currentPage - 1);
            }
            else {
                console.log('nuh-uh');
            }
        });

        $(document).on('click', '.item-activate', function () {
            let dataIdValue = $(this).data('key');
            $.ajax({
                url: 'http://yiitask2back:80/api/user/activate?id=' + dataIdValue,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': 'Bearer ' + Cookies.get('token')
                },
                method: 'POST',
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                success: function (data) {
                    window.location.href = "http://yiitask2front:80/user";
                }
            })
            return false
        })

        $(document).on('click', '.item-ban', function () {
            let dataIdValue = $(this).data('key');
            $.ajax({
                url: 'http://yiitask2back:80/api/user/ban?id=' + dataIdValue,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': 'Bearer ' + Cookies.get('token')
                },
                method: 'POST',
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                success: function (data) {
                    window.location.href = "http://yiitask2front:80/user";
                }
            })
            return false
        })
    });


</script>