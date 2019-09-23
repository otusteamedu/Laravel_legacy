# Онлайн-консультант

## Сущности

* **Company** - регистрирует своих пользователей и создает виджеты для взаимодействия с посетителями сайта
* **Widget** - содержит настройки виджета, в котором посетитель сайта будет общаться с представителем компании
* **Lead** - посетитель сайта, который взаимодействовал с виджетом
* **Conversation** - разговор представителя компании с лидом

## Установка

1. Клонировать репозиторий
2. Установить Laradock и войти в контейнер по SSH
3. `composer install`
4. Скопировать `.env.example` в `.env` и ввести данные MYSQL базы
5. `php artisan migrate`

### [Laradock](https://laradock.io)

1. [Установить Docker](https://docs.docker.com/install/)
2. Скопировать `laradock/env-example` в `laradock/.env` и изменить:
    * PHP_VERSION=7.3
    * MYSQL_VERSION=5.7 (для PMA)
    * MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD
5. [Установить xDebug](https://laradock.io/documentation/#install-xdebug)
6. [Тестовый домен и SSL](https://laradock.io/documentation/#use-custom-domain-instead-of-the-docker-ip)

Запуск: `docker-compose up -d nginx mysql phpmyadmin`<br>
Остановка: `docker-compose stop`<br>
SSH: `docker-compose exec workspace bash`
