## Анализ класса каталог
Файл `catalog.inc.php`

Данный класс не отвечает SOLID, и больше подходит под антипаттерны спаггети и божественный класс.

####Основные ошибки класса по SOLID
- Нарушен принципединной ответвенности, класс отвечает за роутинг, отображения информации и обработку запросов
```php
if(preg_match('/ajax/',$this->info["full_path"])){
    $tmpl = "sections";
    if (is_file($path.$tmpl.'.php')){
        include $path.$tmpl.'.php';
        $this->set_template($TEMPLATE);
    }
    else{
        return false;
    }
    $this->ajax();
    exit;
}
else{
    $par = $this->findPar();
    ...
}
```
- Нарушен принцип открытости/закрытости, класс реализует не абстракную работу с разными сущностями и абстракциями,
а с конкретными и в случае их расширения и изменения придется дорабатывать класс.
```php
$ele[$row['id']] = array(
    'name'		=>	$row['name'],
    'alias'		=>	isset($ele[$row['parent_id']]) ? $ele[$row['parent_id']]['alias'].'/'.$row['alias'] : ($row['parent_id'] == 1 ? 'catalog/'.$row['alias'] : $row['alias']),
    'parent'	=>	($row['parent_id'] == 0) || ($row['parent_id'] == $id) ? null : $row['parent_id'],
    'menu'		=>	$row['show_in_menu'],
    'level'		=>	$level
);
```
- Нарушен принцип подстановки Барбары Лисков, т.к. в классе укзаны чётко сущности с которыми работает класс и в случаи их изменения
класс придется доделывать исходя из новых объектов. В коде мы не плуяам интерфейсов.
- Нарушен принцип разделения интерфейса, в классе реализована работа с разделами `section` и элементами `elements`.
- Класс завист не от абстракции, а от конкретных сущностей
```php
public function __construct($arr_path, $arr_lang, $arr_info, $db){
```
####Доработки которые необходимо произвести
- SRP: Выделить отделье сущности для работы с ними. Создать отдельный класс для роутинга, разделов, товаров и их обработки.
```php
class ElementModel extend Model //класс описания элемента
class SectionModel extend Model //класс описания раздела
class Routing // класс ответсвенный за роутинг
class ElementContrller extend Controller //контроллер элементов
class SectionController extend Controller //контроллер раздлов
class ElementService //логика работы с элеметами
class SectionService //логика работы с разделами
```
- OCP: Для работы с разыми товарами необходимо реазизовать один интерфейс товаров,
от которго будет наследоваться товар и в случае появление других товаров его можно будет заменить.
```php
interface TovarInterface
class Sumka implements TovarInterface
class Rukzak implements TovarInterface
```
- LSP: В качстве входных параметров на вход мы должны получать не конкретный товар а его абстракцию
```php
class ElementService {
    public function __construct(TovarInterface $tovar)
}
```
- ISP: Разделы и элементы необходимо реализовывать на интерфйсах, чтобы при необходимости можно было легко расширить,
не меняя класса для работы с ними.
```php
inteface PageInterface
inetrface SectionInerface
interface TovarInterface
class Section implements SectionInterface, PageInterface
class Element implements ElementInterface, PageInterface
```
- DIP: Для работы с разделами или элементами на вход надо передавать интерфейсы данных сущностей, т.е. конструктор должен выглядеть:
```php
public function __construct(InerfacePage $page, InterfaceLang $lang)
```