## Описание проекта

HTTP-клиент gerfey/battlenet разработанный для работы с Battle.net API.
Клиент доступен для загрузки из Packagist и Composer.

```bash
composer require gerfey/battlenet @dev
```

Полное описание доступно в git репозитории:

```bash
https://github.com/Gerfey/battlenet
```

## Анализ

В первую очередь хотелось бы выделить момент с классом HttpClient:
```php
<?php

namespace Gerfey\BattleNet\Http;

use Gerfey\BattleNet\Regions\RegionInterface;

class HttpClient implements HttpClientInterface
{
    protected $client;

    protected $response;

    protected $verify = false;

    protected $options = [];

    public function createRequest(): BattleNetResponseInterface
    {
        // TODO: Implement createRequest() method.
    }

    public function setNamespace(string $namespace)
    {
        // TODO: Implement setNamespace() method.
    }
}
```
данный класс является родительским для **BattleNetClient** реализует интерфейс **HttpClientInterface**.
По факту он является пустышкой, не реализующий никакой логики, и хранит в себе базовые свойства,
стоило избавиться от него и перенести все свойства на уровень выше в **BattleNetClient**.

### Анализ на уровне SOLID

1. S - Нет нарушений принципа единой отвественности;
2. O - Принцип открытости/закрытости не нарушается;
3. L - Подклассы переопределяют методы базового класса так, чтобы не нарушалась функциональность с точки зрения клиента;
4. I - В проекте не используются толстые-интерфейсы
5. D - Принцип инверсии зависимостей не нарушается.

### Антипатерны

Используются все прелести composer, нет "Божественных" классов, нет спагетти кода, не использовал прелести хардкодинга.