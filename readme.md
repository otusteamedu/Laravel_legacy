Места применения изученных паттернов:
1. Паттерн стратегия  https://github.com/shapito27/Casino/blob/master/app/Services/Prize.php
в $transmiter присваивается PrizeTransmiter - передача приза делегируется классу PrizeTransmiter в методе transfer() класса Prize
2. Паттерн стратегия  https://github.com/shapito27/Casino/blob/master/app/Services/MoneyPrize.php конвертация MoneyPrize делегируется классу PrizeConverter. В свойтство $converter сеттится PrizeConverter и в методе convert() происходит делегирования обязанности.

Что можно доработать в коде с использованием паттернов:

В SubjectPrize(https://github.com/shapito27/Casino/blob/master/app/Services/SubjectPrize.php) в конструкторе создается объект Subject. 

Во первых SubjectPrize не должен отвечать за создание Subject, нужно делегировать это классу SubjectGenerator.
Возможно даже следует создать свойство subjectGenerator в классе, тогда это будет классический паттерн стратегия.
В конструкторе будем делать инъекцию зависимости SubjectGenerator. В итог получим:

```
class SubjectPrize extends Prize
{
    /** @var string  */
    protected $type = parent::SUBJECT;

    public function __construct(SubjectGenerator $subjectGenerator)
    {
        $randomSubject = $subjectGenerator->generate();
        $this->setValue($randomSubject->id);
    }
}
```

Во вторых сам класс SubjectGenerator можно реализовать по паттерну фабричный метод:
```
<?php
interface PrizeGenerator
{
    public function generate():Prize;
}

interface Prize{}

class SubjectGenerator implements PrizeGenerator
{
    public function generate()
    {
        return new Subject();
    }
}

class BonusGenerator implements PrizeGenerator
{
    public function generate()
    {
        return new Bonus();
    }
}

class MoneyGenerator implements PrizeGenerator
{
    public function generate()
    {
        return new Money();
    }
}
```
Классы Money, Bonus, Subject реализуют интерфейс Prize.

Всё выше описанное справедливо и для остальных классов: MoneyPrize(https://github.com/shapito27/Casino/blob/master/app/Services/MoneyPrize.php) и BonusPrize(https://github.com/shapito27/Casino/blob/master/app/Services/BonusPrize.php) с небольшими дополнениями.

Классов Bonus и Money сейчас нет. Создать их и создание new PrizeInterval(которое сейчас в конструкторе BonusPrize и MoneyPrize) использовать в их конструкторах.


