# Домашняя работа #3. Среда разработки и PHP-сокеты

## Среда разработки приложения на PHP

Для разработки будем использовать Laravel Homestead
https://laravel.com/docs/5.8/homestead

###Краткие шаги по установке:
* Установить VirtualBox/VMWare/Parallels 
* Установить Vagrant
* Добавить homestead-box для vagrant:

```
$ vagrant box add laravel/homestead
```

 
* Установить Homestead 

```
$ git clone https://github.com/laravel/homestead.git ~/Homestead
```

* После клонирования репозитория запустить скрипт init.sh из полученной директории для создания конфигурационного файла 
Homestead.yaml
* Сконфигурировать Homestead.yaml (пример конфигурации в Homestead_sample.yaml)
* Запустить Homestead

```
$ cd ~/Homestead
$ vagrant up
```

## PHP-сокеты

Взаимодействие с сокетами реализовано с помощью 
https://www.php.net/manual/en/function.stream-socket-server.php

Для подключения к виртуальной машине - в двух терминалах:

```
$ vagrant ssh
$ cd otus/public/
```

Далее в первом терминале запускаем сервер:
```
$ php otus/public/server.php
```
Во втором - клиент:
```
$ php client.php
```