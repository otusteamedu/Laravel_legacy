<?php


namespace Solyaris\Cmd;


use ReflectionClass;
use ReflectionException;

class CmdDispatcher implements ICmdDispatcher
{
    /**
     * Читаем только один раз при старте.
     * Содержит созданные объекты обработчиков команд
     *
     * @var array
     */
    private $cachedCmdList;

    /**
     * Контекст работы CmdDispatcher
     *
     * @var mixed
     */
    private $target;

    public function __construct()
    {
        $this->cachedCmdList = [];
        $this->target = null;

        $this->init();
    }

    /**
     * Не усложняем: читаем все файлы из поддиректории Impl/,
     * подключаем его и проверяем загружен ли соответствующий класс.
     * Тут кстати неясно, будет ли это все конфликтовать с автолоадером из композера?
     */
    public function init() {
        $cmdNS = __NAMESPACE__."\\Impl";
        $cmdPath = dirname(__FILE__)."/Impl";

        $handle = dir($cmdPath);
        while (false !== ($entry = $handle->read())) {
            if(substr($entry, -4) !== ".php")
                continue;

            $fileName = $cmdPath . "/" . $entry;
            if(!is_file($fileName))
                continue;

            include ($fileName);

            $expectCmdFQCN = $cmdNS . "\\" . substr($entry, 0, strlen($entry)-4);
            if(!class_exists($expectCmdFQCN))
                continue;

            $cmdObject = null;
            try {
                $rc = new ReflectionClass($expectCmdFQCN);
                $cmdObject = $rc->newInstance($this->target);
            }
            catch (ReflectionException $e) {
            }

            if($cmdObject instanceof ICmd) {
                $id = call_user_func_array(array($cmdObject, 'getId'), []);
                $this->cachedCmdList[$id] = $cmdObject;
            }
        }

        $handle->close();
    }

    /**
     * Получить объект команды. Тут подразумеваем, что конструктор реализации ICmd
     * не может быть иным нежели в абстрактном Cmd
     *
     * @param string $id
     * @return ICmd
     */
    public function get(string $id): ?ICmd
    {
        if(!array_key_exists($id, $this->cachedCmdList))
            return null;

        return $this->cachedCmdList[$id];
    }

    /**
     * Получить список всех команд
     *
     * @return ICmd[]
     */
    public function getList(): array
    {
        return $this->cachedCmdList;
    }

    /**
     * Получение помощи по командам.
     * Тут мы не выходим за рамки консольного приложения, т.е. не будем
     * закладывать возможные форматы вывода помощи
     *
     * @return string
     */
    public function printHelp(): string
    {
        $result = "Возможные команды:".PHP_EOL;
        $list = $this->getList();
        foreach($list as $cmdObject) {
            $id = call_user_func_array(array($cmdObject, 'getId'), []);
            $name = call_user_func_array(array($cmdObject, 'getName'), []);

            $result .= sprintf(" - %s: %s", $id, $name).PHP_EOL;
        }

        return $result;
    }

    public function setTarget($target): void {
        $this->target = $target;
    }
}