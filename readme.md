# Д3 №8.  Авторизация и аутентификация

Разрабатываемый проект выкладываю сюда:

* Адрес: [http://188.120.243.205](http://188.120.243.205)
* Логин: lar
* Пароль: p1

Административная панель под суперадмином:
 
* Адрес: [http://188.120.243.205/manager](http://188.120.243.205/manager)
* Логин: vit_ermakov@mail.ru
* Пароль: vit_ermakov

Формы авторизации, регистрации, восстановления пароля встраиваю 
в свой дизайн и назначаю страницам авторизации свои адреса:  
[/routes/web.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/routes/web.php)

##Аутентификация

Административная панель защищается двумя мидлварами: ['auth', 'manager'].
Первый проверяет, чтобы пользователь был авторизован, второй - 
[/app/Http/Middleware/CheckManager.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Http/Middleware/CheckManager.php)
проверяет, чтобы пользователь принадлежал к ролям, которые имеют права 
работать с админпанелью.

Разделение прав внутри разделов идут на основе уровней доступа к модулям.
Под модулем я понимаю просто отдельный функционал. Я выделил такие:

* Пользователи и доступ
* Справочник фильмов
* Кинотеатры, залы, места
* Продажи

Каждому из них соответствует список уровней доступа, например,

* Доступ закрыт
* Просмотр справочников
* Добавление/изменение+удаление своих записей
* Полный доступ

Далее существует страница, назначения различным ролям соответсвующих
прав к модулям: 
[http://188.120.243.205/manager/security/perms](http://188.120.243.205/manager/security/perms).
Тут я немного срезал угол и не стал писать сервис для работы с запросами 
внутри контроллера: [/app/Repositories/ModuleRepository.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Repositories/ModuleRepository.php)

После того как права назначены, для проверки доступа к тому или иному
объекту я использую политики Laravel. Пример для объекта фильма: 
[/app/Policies/MoviePolicy.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Policies/MoviePolicy.php).

Там я с помощью функции ропозитория пользователей requiredAccess проверяю 
достаточность прав на выполнение пользователем действий над моделью.

Далее уже политика автоматически подтягивается средствами Laravel. 
Пример [/app/Http/Controllers/Admin/Movies/Movie/MovieFormController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Http/Controllers/Admin/Movies/Movie/MovieFormController.php)

Сама страница сохранения прав для разнообразия защищена с помощью Gates:
[/app/Http/Controllers/Admin/Security/PermController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Http/Controllers/Admin/Security/PermController.php), описанных тут
[/app/Providers/AuthServiceProvider.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw8/app/Providers/AuthServiceProvider.php). 

Там же подключаются политики. Пока она одна MoviePolicy.
