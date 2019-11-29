# Д3 №10. Кэширование

Вопрос с кешированием в Laravel, делится на 3 части:

1. Настройки обработчика кеширования
2. Вопрос сохранения данных в кеше
3. Вопрос сброса кеша

## Настройки обработчика кеширования

С этим пунктом нет особых проблем нет, попробовал Memcached, Redis. Все работает. Пока вернул обратно на file, так как на сервере куда я выкладываю работу нет возможности ставить ПО. Позже рассмотрю вариант выкладывания на Яндекс.Облако.

## Вопрос сохранения данных в кеше

Обдумывая этот вопрос в рамках тестового проекта, я пришел к выводу, что кеширование я буду
использовать как фичу к методам сервисов. Например, у сервиса [/app/Services/MovieService.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Services/MovieService.php) будут реализованы методы работы с сущностями, которые будут запрашивать данные из хранилища без кеша:

* **getSoonInRental(int $nLastCount): array**
* **getInRentalRand(int $nCount): array**
* и т.д...

и для них нужно реализовать копии, например **getSoonInRentalCached(int $nLastCount, CD cacheParams)**, которые будут запрашивать те же данные, но только опосредованно через кеширование, как бы обертывая исходный метод. Так как это будет одинаковых код для всех вызовов сделаем его типовым даже не отражая спецификацию этого метода в интерфейсе сервиса.

Для этого:
1. вводим структуру, содержащую настройки кеширования [App\Base\Service\CD](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Base/Service/CD.php), где можно указывать необходимые параметры кеширования - ключ, теги, TTL
2. в рамках базового сервиса [App\Base\Service\BaseService](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Base/Service/BaseService.php) реализуем магический метод __call

```php
/**
     * Пытаемся вызвать некеширущую версию метода, если он оканчивается на
     * Cached, иначе пытаемся найти метод с таким же названием в репозитории по-умолчанию.
     * Если вызывается кешированная версия метода, но без параметров кеширования последним аргуметом,
     * делаем его по-умолчанию
     *
     * Результат возвращаем в виде ассоциативного массива
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments )
```

Там же для кучи реализуем возможность проброса запроса напрямую в связанный репозиторий, для случаев, когда в методе сервиса не реализуется никакой дополнительной логики. Последнюю возможность я буду использовать редко, так как спецификацию метода надо отразить в интерфейсе. 

По моей задумке не уровне репозитория будет реализовываться работа только с базой данных и возвращать она будет коллекцию моделей, чтобы далее на уровне сервиса легко было бы подтягивать связанные сущности. Пример [App\Repositories\MovieRepository](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Repositories/MovieRepository.php):

```php
/**
     * Получить фильмы, которые будут скоро в показе.
     * 1. Дата премьеры должна быть больше текущей
     * 2. Сеансы должны существовать
     * 3. Дата-время первого сеанса должна быть больше текущего
     *
     * @param int $nLastCount
     * @return Collection
     * @throws \App\Base\WrongNamespaceException
     */
    public function getSoonInRental(int $nLastCount): Collection
```

Сервис должен обработать данные до уровня DTO для вставки в шаблонизатор или ответ API. Пример: [App\Services\MovieService](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Services/MovieService.php).

```php
    /**
     * Получить ближайшие фильмы в прокате
     *
     * @param int $nLastCount
     * @param CD|null $cache
     * @return array
     * @throws \Exception
     */
    public function getSoonInRental(int $nLastCount): array {
        /** @var IMovieRepository $repository */
        $result = [];
        $repository = $this->getRepository();
        $repository->getSoonInRental($nLastCount)->map(
            function($movie) use (&$result) {
                /** @var Movie $movie */
                $item = $movie->toArray();
                $item['poster'] = $movie->poster->toArray();
                $item['premiereDate'] = AdminHelpers::Date_db_site($item['premiereDate']);
                $result[] = $item;
            }
        );
        return $result;
    }
```

Теперь сводим все это вместе в контроллере, используя кеширующую версию метода getSoonInRental(int $nLastCount): [App\Http\Controllers\Publica\StartController](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Http/Controllers/Publica/StartController.php)


```php
    public function index()
    {
        $fs = $this->fileService;
        $rs = $this->resizeService;
        $premierMovies = $this->movieService->getSoonInRentalCached(4, new CD('top_premier', 3600*24, ['top_premier', 'all_movies']));
        array_walk($premierMovies, function (&$movie) use ($fs) {
            /** @var FileService $fs */
            $movie['poster'] = $fs->getLocalFileArray($movie['poster']);
            $movie['poster_url'] = $movie['poster'] ? $fs->getAssetFile($movie['poster']) : null;
        });
        $showingMovies = $this->movieService->getInRentalRandCached(6, new CD('rand_showing', 3600*12, ['rand_premier', 'all_movies']));
        array_walk($showingMovies, function (&$movie) use ($fs, $rs) {
            $movie['poster'] = $fs->getLocalFileArray($movie['poster']);
            $movie['poster_thumb'] = $movie['poster'] ? $rs->ResizeImage($movie['poster'], [
                'type' => ResizeService::RESIZE_CROPPING,
                'width' => 360,
                'height' => 215
            ]) : null;
            $movie['poster_thumb_url'] = $movie['poster_thumb'] ? $fs->getAssetFile($movie['poster_thumb']) : null;
        });
        return view('public.start.index', compact('premierMovies','showingMovies'));
    }
```

**Ура! все работает.**

## Вопрос сброса кеша

Данные в кеш мы загнали, а теперь вопрос как его оттуда сбросить. Особенно в случае когда в проекте будет пару десятков связанных зависимостей.

Точка сброса кеша - это обработчик события, вызанного из метода сервиса. Например, добавляется новый фильм, выбрасывается событие добавления **MovieEvent::STORED** в [App\Services\MovieService](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Services/MovieService.php)

```php
    public function store(array $data): Model {
// ...
        event(new MovieEvent($movie, MovieEvent::STORED));
//...
    }
```

Далее для инкапсулирования логики обработки сброса кеша, ассоциированного с моделю, используем наследника [App\Base\ModelCache](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Base/ModelCache.php) - [App\Forget\MovieCache](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Forget/MovieCache.php).

Сам класс забывания я не проработал, просто возвращаю там все ключи. По идее надо в случае добавления нового фильма, у которого дата премьеры большая, текущей возвращать только ['top_premier']. Но на конкретной реализации я сейчас останавливаться не буду. Просто набрасываю шаблон для дальнейших размышлений.

Само сбрасывание кеша происходит в обработчике событий, там где регистрируются подписчики - [/app/Providers/EventServiceProvider.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw10/app/Providers/EventServiceProvider.php).

```php
    public function boot()
    {
        parent::boot();
        //
        Event::listen(MovieEvent::class, function(MovieEvent $event)
        {
            // dd($event->getMovie()->actors()->pluck('actor_id'));
            // Обработка события...
            $forgetKeys = (new MovieCache($event))->getForgetKeys();
            if(!empty($forgetKeys))
                call_user_func_array([app('cache'), 'forget'], $forgetKeys);
        });
    }
```

---

Разрабатываемый проект выкладываю сюда:

* Адрес: [http://188.120.243.205](http://188.120.243.205)
* Логин: lar
* Пароль: p1

Административная панель под суперадмином:
 
* Адрес: [http://188.120.243.205/manager](http://188.120.243.205/manager)
* Логин: vit_ermakov@mail.ru
* Пароль: vit_ermakov
