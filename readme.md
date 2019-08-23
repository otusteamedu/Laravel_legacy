# Д3 №2. Паттерны проектирования в своем проекте

## 1. Шаблон архитектурного уровня

Так как, для написания приложения я использую Framework Symfony4 (в рамках изучения), то я следую автоматически многим архитектурным подходам, заложенным в ней. Опишу две. 

В описанных примерах код – не рабочий, в большинстве случаев для демонстрации каких-то намерений, приложение создается.

**1.1. Паттерн MVC**. Этот подход рекомендует нам делить веб-приложение на три независимых компонента:

- Модель – отвечает за манипуляцию с данными. Она должна быть отвязана от логики работы самого предложения, но у меня так не выходит. Опишу ситуацию.

	Так как писать я пытаюсь в ООП-стиле, то для меня важно, чтобы модель принимала объекты, списки объектов и сохраняла их в БД, и, наоборот, восстанавливала из БД уже готовые для использования объекты и списки объектов. За бизнес-логику в Symfony отвечают компоненты Doctrine. Слой работы с данными определяет 2 типа прикладным объектов (которые необходимо создавать программисту) - объекты, содержащие только данные, - Entity (plain objects) и соответствующие управляющие классы Repository. 

    [/src/Entity](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw2/src/Entity) - проектируемые Entity

    [/src/Repository](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw2/src/Repository) - соответствующие им Repository

    Я *пока* отхожу от этой замечательной схемы и, как правило, внедряю в  Entity  разные зависимости, например, репозитории, чтобы извлекать связанные с Entity другие Entity, которые нельзя извлечь автоматически с помощью аннотаций ORM. 

    **Некоторые примеры:**

    [/src/Entity/Supplier.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/Supplier.php) - пример Entity Supplier – просто поставщик. Тут все ясно, у поставщика есть имя, описание, картинка. Он принадлежит – ассоциация ManyToOne – пользователю User.

    [/src/Entity/SupplierHandler.php](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/SupplierHandler.php) - пример Entity SupplierHandler – каждый поставщик будет обрабатываться цепочкой объектов интерфейса [IWorkerTask](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/IWorkerTask.php) (обработка задачи по шагам, см. [прошлое ДЗ](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw1)). Например, сначала большой файл экспорта XML необходимо скачать пошагово (он может весить пару сотен мегабайт) с помощью     [Downloader (implements IWorkerTask)](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/Downloader.php) потом передать его в выбранного неабстрактного наследника [XmlParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XmlParser.php), например [YmlParser (extends XmlParser implements IWorkerTask)](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/YmlParser.php) для вдумчивого анализа и последующего сохранения в хранище. Обработчики должны запускаться по цепочке, используя, данные друг друга. 

    **Возвращаясь к [SupplierHandler](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/SupplierHandler.php)**, мы видим уже усложнение. В сущности [SupplierHandler](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/SupplierHandler.php) мы будем хранить уникальный код обработчика и его настройки в виде текстового поля с json-чиком. Сам обработчик не является сущностью БД, но мне бы хотелось в SupplierHandler иметь метод getObject/setObject, который бы возвращал/сохранял по полям уже созданный и инициализированный объект обработчика. В данном случае все решилось малой кровью через использование синглтона HandlerCollection, а не встроенной в Entity зависимостью в виде объекта, но уже получили тесную связь между объектами  SupplierHandler и HandlerCollection. Как вариант, объект HandlerCollection можно передавать как параметр в getObject, чтобы не получать его внутри. Т.е. как-то так

    ```php
    /**
     * Получить объект обработчика
     */
    // public function getObject(HandlerCollection $hc) - а может надо так?
    public function getObject() {
        $config = json_decode($this-getOptions());

        $handler = HandlerCollection::instance()->find($this->getCode());
        if(!$handler)
            return null;

        $handler->setConfig($config);
        return $handler;
    }

    /**
     * Созранить объект обработчика
     */
    public function setObject(Handler $handler): self {
        $config = json_encode($handler->getConfig()->getData());
        
        $this->setCode($handler->getId());
        $this->setOptions($config);

        return $this;
    }
    ```

    **Мне кажется, что я иду не в ту сторону и не могу предсказать где все это выйдет боком <font color="#cc0000">и хотел бы, чтобы преподаватель подсказал, как тут быть.
    </font>**

    Также есть и другой случай, есть сущности:

    [Product](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/Product.php) – обычный товар
    
    [ExternalFile](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/ExternalFile.php) – ссылка на доступные по HTTP на других серверах файлы

    [ProductFile](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Entity/ProductFile.php) – таблица связи Product и ExternalFile, включающая некоторые дополнительные поля, например, ссылка на тип файлов (тип – это доп., картинки, мануалы, даташиты и прочее).

    Мне бы хотелось внутри Product иметь метод getFilesByType ($type), который выдает файлы только определенного типа. Но аннотации ORM не дают возможности накладывать произвольные фильтры вдобавок к фильтру по внешнему ключу. 

    ```php
    /**
     * получить список файлов только типа $type
     */
    public function getFilesByType($type) {
    /**
     * тут конечно можно взять getFiles(), а потом пробежаться
     * c помощью array_filter(...), но если прикрепленных файлов будет 100, а необходимо 
     * выбрать 10, то резко снижается КПД. Значит надо взять только те файлы, что необходимо,
     * а значит надо иметь ссылку на ProductFileRepository.
     * Значит, ее надо либо внедрить, либо передавать по ссылке 
     * 
     * public function getFilesByType(ProductFileRepository $pfr, $type)
     * 
     */

        return $this->pfr->find([
            'product' => $this,
            'type' => $type
        ]);
    }
    ```

    **<font color="#cc0000">Вопрос преподавателю: как быть в таких случаях? Передавать ссылку на ProductFileRepository по ссылке или использовать внедрение репозитория в Product. Последнее можно автоматизировать по примеру https://habr.com/en/post/173275/. Правда, там надо доработать Injector.</font>**

    **Наставление о том, что объекты Entity должны быть полнофункциональными объектами, не привязанными к способу хранения данных, а не пустышками с сеттерами-геттерами я взял отсюда https://youtu.be/WW2qPKukoZY?t=430**
    

- За представление данных отвечает расширяемый шаблонизатор Twig + Bootstrap. Тут вопросов нет: Twig принимает какие-то данные и их просто выводит. Единственный отход от теоретической модели MVC – это то, что представление внутри себя может запускать контроллеры, например, выводить вспомогательные блоки (форма авторизации, системное меню). Но пока эти блоки выполняют только роль вывода HTML путем, по сути, переброски на другой шаблон Twig с посредником в виде контроллера лично меня это не напрягает, так как контроллер не выполняет никаких действий – только берет данные из БД и вызывает другой шаблон Twig.

- За обработку логики отвечают классы контроллеры. За область действия контроллера я понимаю управление какой-либо сущностью предметной области, например, Поставщик. Разные же CRUD и иные операции делятся по методам класса-контроллера. Роутингом я управляю с помощью аннотаций.

    [Controllers\SupplierController](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Controller/SupplierController.php), метод Controllers\SupplierController::new

**1.2. Паттерн IoC, он же принцип SOLID**. 

При разработке на Symfony я также использую такой подход как IoC – т.е. конструкторы, сеттеры, да и просто методы-обработчики мы передаем ожидаемые интерфейсы, а не реализации. Реализовано это все с помощью DI. Контейнеры Symfony управляют широким спектром объектов, начиная от контроллеров, шаблонизаторов, менеджеров сущностей БД, продолжая сервисными объектами, типа логгеров, обрабочиками запроса, репозитории объектов БД, заканчивая объектами пользователей.

Примеры:

- [FileUploader](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Service/FileUploader.php) - менеджер загрузки файлов
- [TaskManagerDB](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/TaskManagerDB.php) - Менеджер пошаговых операций 

Конфигурируются они в parameters.yaml  и services.yaml

```yaml
# ...
parameters:
    upload_directory: '%kernel.project_dir%/public/uploads'

# ...
services:
    # ...
    App\Service\FileUploader:
        arguments:
            $targetDirectory: '%upload_directory%'

    App\Common\Worker\TaskManagerDB:
        arguments:
            $em: ['@doctrine.orm.entity_manager']
            $timeout: 30

```

## 2. Паттерны ООП

**Паттерн Адаптер** –  [XMLParserAdapter](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLParserAdapter.php).

Как адаптер, он содержит минимум логики, а в основном передает запросы между разрабатываемым классом пошагового и конфигурируемого XML-анализатора.

[XmlParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XmlParser.php) – с ним адаптер находится в отношении композиция

и

[XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php) – c ним адаптер находится в отношении наследования.

**Паттерн шаблонный метод** – реализуется в [XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php). 
Тут сами методы [XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php)::_exec_handlers, [XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php)::start, а в его наследнике мы должны реализовывать методы, используемые внутри эти шаблонных методов: 

* [XMLParserAdapter](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLParserAdapter.php)::onChain – вызывается через посредника [XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php)::onElement

* [XMLParserAdapter](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLParserAdapter.php)::onChainRule – вызывается через посредника [XMLAbstractParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLAbstractParser.php)::onElement

* [XMLParserAdapter](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XMLParserAdapter.php)::isMustInterrupt


**Паттерн Строитель** в обрезанном варианте представлен в [ParserChain](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/ParserChain.php)::AddRule для построения дерева правил для обработки файлов XML. Само дерево правил является членом  [ParserChain](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/ParserChain.php). Во всех неабстрактных наследниках [XmlParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/XmlParser.php) будет использоваться только этот строитель (они только им и будут отличаться). Пример: [YmlParser](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/YmlParser.php)

Также этот паттерн в более правильном варианте в виде отдельного строителя используется при создании форм Symfony
[SupplierType](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Form/SupplierType.php).

**Паттерн Стратегия** используется в отношении объектов [TaskManager](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/TaskManager.php) через реализаций [IWorkerTask](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/IWorkerTask.php). Объекты, реализующие [IWorkerTask](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/IWorkerTask.php), полностью будут определять то, что именно будет делать [TaskManager](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Worker/TaskManager.php) в методе process().

**Паттерн Синглтон** – используется в классе  [HandlerCollection](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Handler/HandlerCollection.php) – класс, управляющий существующими обработчиками пошаговых операций. Он нужен один.

## 3. Необходимые доработки

1. Плохое деление по неймспейсам, о чем было указанно в прошлый раз, это будет перерабатываться после разработки первой минимальной рабочей версии.

2. Непонятное описание методов для phpDocumentor.

3. Код совершенно не покрыт тестами, я пока не знаю как это делать, буду учиться после выпуска первой минимальной версии. Понимаю, что тут не реализуется принцип TDD, но этой для меня еще сложнее, займусь этим в перспективе 2 месяцев.

4. Использовать уже готовые решения, а не изобретать ужасные “трех с половиной –колесные цепью через руль” велосипеды. Например, для закачки файлов можно использовать нормальный HTTP-Client GuzzleHttp или аналогичный из Symfony, а не свой класс [Download](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw2/src/Common/Download.php), тем более, что с со временем эти вещи должны войти в PSR, что упростит замену одного решения или велосипеда на другое без использования всяких адаптеров.
