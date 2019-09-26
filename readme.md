# Д3 №7. Начало админки

На данный момент систематизирую полученный материал, но само ДЗ выполняю в облегченной форме, чтобы "прощупать" Laravel. 
Он для меня новый, как и работа с такой реализацией ActiveRecord как Eloquent. Поэтому я решил сначала написать сырой код с дальнешим упорядочиванием.

Пока я не ввожу в обработку запросов слоя Service. Думаю, что мне пока хватит управления выборками [Repository](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw7/app/Repositories), остальную логику буду складывать в контроллер (кроме валидации и проверки прав). 

Как сервис я пока планирую использовать какой-то отдельный функционал, например, загрузчик файлов [./app/Services/FileService.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw7/app/Services/FileService.php)

До момента выполнения перечисленных в ближайших задачах пунктов буду работать со страницами, связанными с управлением фильмами.

1. Страны [/app/Http/Controllers/Admin/Movies/CountryController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw7/app/Http/Controllers/Admin/Movies/CountryController.php)
2. Жанры [/app/Http/Controllers/Admin/Movies/GenreController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw7/app/Http/Controllers/Admin/Movies/GenreController.php)
3. Люди [/app/Http/Controllers/Admin/Movies/PersonController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw7/app/Http/Controllers/Admin/Movies/PersonController.php)
3. Фильмы [/app/Http/Controllers/Admin/Movies/MovieController.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw7/app/Http/Controllers/Admin/Movies/MovieController.php)

Шаблоны складываю сюда
* [/resources/views/admin](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw7/resources/views/admin)

Разрабатываемую админку выкладываю сюда:

* Адрес: [http://188.120.243.205/manager](http://188.120.243.205/manager)
* Логин: lar
* Пароль: p1

В ближайшей задачи входит:

1. Добавление авторизации и разделения доступа на основе ролей 
2. Проработка валидации, как отдельного элемента.
3. Добавления к спискам фильтрации (каждому списку своя)
4. Добавление групповых операций
