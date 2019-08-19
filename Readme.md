#Solid 

###S
Проблема: при дальнейшем расширении класса (например мы решили добавить уведомление в Telegram)
необходимо править class SenderService, а так же создавать новый класс TelegramSender.
 
```php
<?php

namespace Service;

use Exception;

class SenderService
{

	/**
	 * @param string $event
	 * @param array $data
	 *
	 * @return void
	 */
	public static function sendLazyMail(string $event, array $data)
	{
		try {
			/** @noinspection PhpUndefinedClassInspection */
			MailEvent::LazySend($event, $data);
		} catch (Exception $exception) {
			self::sendToSlack($event, $data);
		}
	}

	/**
	 * @param string $event
	 * @param array $data
	 *
	 * @return void
	 */
	public static function sendToSlack(string $event, array $data)
	{
		/** @noinspection PhpUndefinedClassInspection */
		$slack = new Client();
		/** @noinspection PhpUndefinedMethodInspection */
		$slack->attach([
			'fallback' => ' ',
			'text' => $event,
			'color' => 'danger',
			'fields' => [
				[
					'title' => $event,
					'value' => var_export($data, true),
					'short' => true
				],
			]
		])->send($event);
	}

}
```

Предполагаемое решение: создать интерфейс SenderInterface , в классе 
SenderService реализовать конструктор, который в параметрах будет принимать 
экземпляр класса, который выполняет интерфейс SenderInterface

```php
<?php

interface SenderInterface {
    public function send(string $event, array $data);
}

class SenderService implements SenderInterface
{
    protected $sender;
    
    public function __construct(SenderInterface $sender)
    {
	    $this->sender = $sender;
    }
    
    public function send(string $event, array $data)
    {
		$this->sender->send($event, $data);
    }

}
```

###O

Проблема: при необходимости использования нескольких репозиториев (например реплика)
необходимо создавать модифицировать реализацию метода, или создавать класс-наследник
с переопределенным методом getGoodById. в том случае, если этот код так же используется 
и на другом сервере (приложении), но там нет реплики - возникнут проблемы.
 
```php
<?php

    class GoodService {
    	
        public static function getGoodById(int ...$id) :array
        {
            $collection = MysqlGoodRepository::getById($id);

            return $collection ?? [];
        }

    }
```

Решение:

```php
<?php

    interface GoodServiceRepositoryInterface {
        public static function getById(array $id) :?array;
    }

    class GoodService {
    	
        private $repository;

        public function __construct(GoodServiceRepositoryInterface $repository) 
        {
            $this->repository = $repository;
        }

        public function getGoodById(int ...$id) :array
        {
            $collection = $this->repository::getById($id);

            return $collection ?? [];
        }

    }
```

