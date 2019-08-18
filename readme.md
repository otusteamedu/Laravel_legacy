Проблемы
=====================
1.  https://github.com/shapito27/Casino/blob/master/app/Services/BonusPrize.php
	https://github.com/shapito27/Casino/blob/master/app/Services/MoneyPrize.php
	https://github.com/shapito27/Casino/blob/master/app/Services/PrizeInterval.php
	***
	Создание объекта класса в конструкторе через ```new PrizeInterval()```.
	***
	Нарушение принципов **SOLID**:
	***
		1) SRP - зависимость от класса PrizeInterval
		2) DIP - зависимость от класса PrizeInterval, а не от абстракции.
	Решение:
	***
	1.Для классов BonusPrize и MoneyPrize надо сделать ```PrizeInterval``` аргументом конструктора:
    ***
    ```__construct(App\Services\PrizeInterval $prizeInterval)```
    ***
    Но при этом сейчас конструктору класса ```PrizeInterval``` нужно аргументом передавать ```$this::getClassName()```. Придется сделать setter.
    ***
    2.Для класса PrizeInterval в методе ```createInterval()``` надо инжектить ```PrizeInterval```

Вопросы
=====================
1. Такой пример:
    
    ```
    class Sources
    {
        public function generateUrls(array $sites)
        {
            $res = [];
            
            foreach($sites as $site){
                $res[] = new Url();
            }
   
            return $res;
        }
    }
    ```
    В методе используется ```new``` в цикле. 
    
    Инжектить объект класса будет неправильно. т.к. в generate() в цикле на каждой итерации создается новый объект. Как быть в таком случае?
    Делать фабрику Url и передавать аргументом в метод ```generateUrls```?
2. https://github.com/shapito27/Casino/blob/master/app/Services/Subject.php
метод ```markAsNotAvailable()```.
Не нарушает ли solid статический вызов метода модели 
```\App\Models\Subject::findOrFail()```
3. ```new MyClass``` нарушает **solid**, а если использовать ```app('MyClass')``` будет ли нарушение?