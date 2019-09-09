<?php


namespace Solyaris\Cmd\Impl;


use Solyaris\App\Config;
use Solyaris\App\Option;
use Solyaris\App\Options;
use Solyaris\Cmd\Cmd;
use Solyaris\Cmd\CmdArgsException;
use Solyaris\Cmd\CmdExecException;

/**
 * Считает выражения типа
 * 1+2*(11-3)-log10(5+4+8/8)+3^(2+1)
 *
 * Class CalcCmd
 * @package Solyaris\Cmd\Impl
 */
class CalcCmd extends Cmd
{
    const OPERATIONS = ['+', '-', '*', '/', '^'];
    const OPEN_BRACKET = '(';
    const CLOSE_BRACKET = ')';
    const SPACE = ' ';
    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return new Options([
            new Option('expression', Option::T_STRING, 'выражение', "", "1+2*(11-3)-log10(5+4+8/8)+3^(2+1)")
        ]);
    }
    /**
     * @param Config $config
     * @throws CmdArgsException
     */
    public function validate(Config $config)
    {
        $expression = $config->get('expression');
        if(strlen($expression) <= 0)
            throw new CmdArgsException("не указано выражение");
    }
    /**
     * @return string
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    public function execute(): string
    {
        $config = $this->getExecConfig();
        $expression = $config->get('expression');
        $value = $this->Calculate($expression);
        return number_format($value, 2, ".", "");
    }

    private function Clear(string $string): string {
        if(strlen($string) <= 0)
            return '';

        $result = '';
        $len = strlen($string);
        for($i = 0; $i < $len; $i++) {
            // чтобы без всяких приколов с UTF-8
            $char = substr($string, $i, 1);
            if(self::SPACE != $char)
                $result .= $char;
        }

        return $result;
    }

    /**
     * @param string $expression
     * @return float
     * @throws CmdExecException
     */
    protected function Parse(string $expression): float {
        $cnt_bracket = 0;
        $cl = strlen($expression);
        if($cl <= 0)
            throw new CmdExecException("Пустое выражение");

        // раскрываем скобки
        if(($expression[0] == self::OPEN_BRACKET) && ($expression[$cl-1] == self::CLOSE_BRACKET)) {
            $expression = substr($expression, 1, $cl - 2);
            $cl -= 2;
        }

        // если анализировать некуда, то возвращаем что есть
        if(is_numeric($expression))
            return (float)$expression;

        // сначала ищем простую операцию, начинаем с менее приоритетных
        // если находимся внутри открытой скобки не ищем
        // если к концу поиск скобка открыта, ошибка
        $cp = count(self::OPERATIONS);
        for ($i = 0; $i < $cp; $i++) {
            $op = self::OPERATIONS[$i];
            for ($j = 0; $j < $cl; $j++) {
                switch($expression[$j]) {
                    case $op:
                        if($cnt_bracket == 0) {
                            $left = substr($expression, 0, $j);
                            $right = ($j < $cl-1) ? substr($expression, $j + 1) : '';
                            return $this->callOper($left, $right, $op);
                        }
                        break;
                    case self::OPEN_BRACKET:
                        $cnt_bracket++;
                        break;
                    case self::CLOSE_BRACKET:
                        if($cnt_bracket <= 0)
                            throw new CmdExecException("Неверно расставлены скобки");
                        $cnt_bracket--;
                        break;
                }
            }
        }

        // может это вызов функции
        if(preg_match("/^([a-z][a-z0-9_]*)\(([^\)]*)\)$/i", $expression, $m))
        {
            $args = strlen($m[2]) ? explode(",", $m[2]) : [];
            $name = $m[1];

            return $this->callFuction($name, $args);
        }

        throw new CmdExecException("Ошибки в составлении выражения");
    }

    /**
     * @param string $name
     * @param array $args
     * @return float
     * @throws CmdExecException
     */
    private function callFuction(string $name, array $args): float {
        if(!function_exists($name))
            throw new CmdExecException("Функция ".$name." не найдена");

        $fArgs = [];
        foreach($args as $arg)
            $fArgs[] = $this->Parse($arg);

        // тут эту функию надо загнать в коробку
        $result = call_user_func_array($name, $fArgs);

        if(!is_numeric($result))
            throw new CmdExecException("Функция ".$name." вернула нечисловое значение");

        return $result;
    }

    /**
     * @param string $left
     * @param string $right
     * @param string $op
     * @return float
     * @throws CmdExecException
     */
    private function callOper(string $left, string $right, string $op): float
    {
        $fleft = $this->Parse($left);
        $fright = $this->Parse($right);

        $result = 0.00;
        if($op == '+')
            $result = $fleft + $fright;

        if($op == '-')
            $result = $fleft - $fright;

        if($op == '*')
            $result = $fleft * $fright;

        if($op == '/') {
            if($fright == 0)
                throw new CmdExecException("Старое доброе деление на 0");
            $result = $fleft / $fright;
        }

        if($op == '^')
            $result = pow($fleft, $fright);

        return $result;
    }

    /**
     * @param string $expression
     * @return float
     * @throws CmdExecException
     */
    private function Calculate(string $expression) {
        $expression = $this->Clear($expression);
        return $this->Parse($expression);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return "Вычисляет выражения";
    }
}