# docker

В директории docker/ вызвать команду `docker-compose up`. В браузере localhost:8000. Порт можно поменять в docker-compose.yml.
UPD:                                                    
Переименовал .env в .env.example.
Вместо порта 9000, nginx и php-fpm общаются через сокет.
В директории docker/code реализован скелет MVC-фреймворка, точка входа в приложение docker/code/public/index.php. Системные компоненты находятся в docker/code/Core, пользовательский код в docker/code/App.
Для примера реализован один контроллер с тремя методами.

# socket

В директории socket/ сгенерировать autoload командой `composer dump-autoload`. Запускать сервер и клиент командами

```
php server.php
php client.php
```
