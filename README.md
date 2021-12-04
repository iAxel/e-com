## Simple Rest Api APP

### Features
- Authentication with multiple sessions
- List of clients models
- List of client orders
- List of client transactions

### Requirements
1. PHP 8.0
2. Composer
3. MySQL 8.0

### Actions before start
1. Create User on MySQL
2. Create Database on Mysql
3. Configure .env file
4. Enjoy :)

### Fast start
1. Run `composer install` command
2. Run `php artisan migrate --seed` command
3. Run `php artisan serve` command
4. Enjoy ;)

### Endpoints
| METHOD | URI                             |
|--------|---------------------------------|
| POST   | auth/login                      |
| POST   | auth/logout                     |
| GET    | users                           |
| GET    | users/{user}                    |
| GET    | clients                         |
| GET    | clients/{client}                |
| GET    | clients/{client}/orders         |
| GET    | clients/{client}/transactions   |
| GET    | profile                         |
| GET    | profile/sessions                |
| DELETE | profile/sessions/delete/{token} |
| DELETE | profile/sessions/delete-all     |
