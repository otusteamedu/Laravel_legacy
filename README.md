# Рабочая среда для будущего проекта

На текущий момент проект представляет собой стандартное приложение Laravel 6.0.

## Инструкция по запуску

1. Скопировать файл `.env.example` в `.env`:
```
cp .env.example .env
```

2. Сгенерировать ключ приложения (который будет прописан в `.env`)
```
php artisan key:generate 
```

3. Установить подготовленную среду запуска на основе Laradoc, клонирование репозитория в корень проекта:
```
git clone --single-branch --branch my git@github.com:pqr/laradock-p.git
```
Репозиторий `pqr/laradock-p` - это форк официального репозитория Laradoc, в котором внесены некоторые изменения в настройки образов.
Все изменения ведутся в отдельной ветке `my` - именно её мы и клонируем командой выше.

4. Перейти в директорию `laradock-p` и скопировать файл `env-example` в `.env`
```
cd laradoc-p
cp env-example .env
```

5. Находясь в директории `laradock-p` запустить окружение с поомщью docker-compose (на машине должен быть установлен Docker):
```
docker-compose up -d nginx mysql
```

6. Сайт должен отрываться по адресу `http://localhost:8000`

7. Для остановки Docker сервисов необходимо выполнить следующую команду, находясь в директории `laradock-p`
```
docker-compose down
```

## Настройка окружения с помощью Laradoc

Ключевые настройки окружения находятся в файле `laradock-p/.env`, вот они:
```
# Задаёт порт на локальной машине на котором будет виден nginx   
NGINX_HOST_HTTP_PORT=8000

# Настройки подключения к MySQL
MYSQL_DATABASE=default
MYSQL_USER=default
MYSQL_PASSWORD=secret
# Порт в переменной окружения MYSQL_PORT - это порт который будет использоваться на локальной (хост) машине, чтобы подключиться к MySQL через удобный GUI интерфейс 
MYSQL_PORT=33061
MYSQL_ROOT_PASSWORD=root

# Директория куда будут проброшены различные volume из Docker. В частности, здесь будет volume для хранения данных MySQL
DATA_PATH_HOST=../storage/laradock/data
```

В соответсвии с настройками окружения в `laradock-p/.env`, настраиваются и параметры подключения базе в самом Laravel проекте.
Исходный `.env.example` в корне проекта уже содержит эти настройки, при копировании его в `.env` всё должно заработать без дополнительных правок.
Перечислим ещё раз настройки подключения к базе данных описываемые в корне проекта в файле `.env` для ясности:
```
DB_CONNECTION=mysql
# Имя хоста внутри Docker сети совпадает с именем сервиса в docker-compose.yml, т.е. просто "mysql"
DB_HOST=mysql
# Порт подключения к базе внутри Docker сети стандартный 3306
DB_PORT=3306
# Имя базы, пользователь и пароль совпадают с указанными в настройках laradock-p/.env
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
``` 

## Настройка ide-helper

```
php artisan ide-helper:generate
php artisan ide-helper:meta
```
