Project deployment, commands to run:

1. Clone project to your folder "git clone https://github.com/olegtsapok/laravel_resapi_test.git"
2. Go to project directory "cd symfony_restapi_test"
3. Load vendors "composer update"
4. Create database and tables "php artisan migrate"
5. Run project as server "php artisan serve"
6. Now project is available by url "http://127.0.0.1:8000"


Additional steps for unit tests:
1. Create test database and tables "php artisan migrate --env=testing"
2. Run unit tests "php artisan test"