1. После установки на сервер необходимо запустить миграцию: php yii migrate
2. Применить фикстуры: yii fixture/load "*"
3. Для работы RBAC необходимо запустить миграцию: php yii migrate --migrationPath=@yii/rbac/migrations
4. После миграции для RBAC нужно запустить её инициализацию: php yii rbac/init
5. Если порт HTTP иной от 80, сменить в ajax запросах на соответствующий
6. работает на сервере с конфигом apache версии 2.4 для php от 7.2 до 7.4; php версии 7.4
7. вход в аккаунт администратора, логин: admin; пароль: 123456789
8. остальный данные для входа находятся в данных фикстуры user.php (common/fixtures/data)
9. обращение к папке frontend через алиас yiitask2front, у папки backend это yiitask2back
10. обращение к API: http://yiitask2back:%номер_http_порта%/api/%действие_API%; как пример http://yiitask2back:80/api/users вернет index страницу со списком пользователей
