# docker

В директории docker/ вызвать команду `docker-compose up`. В браузере localhost:8000. Порт можно поменять в docker-compose.yml.
В коде index.php создаётся подключение к MySQL, к memcache (сохраняется строка на 10 секунд, при перезагрузке страницы должна извлечься из кеша) и выводится phpinfo() для проверки работы всех трёх контейнеров.

# socket

В директории socket/ сгенерировать autoload командой `composer dump-autoload`. Запускать сервер и клиент командами

```
php server.php
php client.php
```
