1. После установки на сервер необходимо запустить миграцию: php yii migrate
2. Для работы RBAC необходимо запустить миграцию: php yii migrate --migrationPath=@yii/rbac/migrations
3. После миграции для RBAC нужно запустить её инициализацию: php yii rbac/init
4. Применить фикстуры yii fixture/load "*"
php yii migrate --migrationPath=@yii/rbac/migrations
php yii rbac/init 