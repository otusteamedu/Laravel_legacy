<?php

$sleep = 6; // фейковая задержка
$rightSmsCode = "123456";
$result = [
    'status' => 'error',
    'message' => 'Неизвестная команда'
];

$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : '';
$card_number = isset($_REQUEST['card_number']) ? $_REQUEST['card_number'] : '';
$card_person = isset($_REQUEST['card_person']) ? $_REQUEST['card_person'] : '';
$card_term = isset($_REQUEST['card_term']) ? $_REQUEST['card_term'] : '';
$card_csv = isset($_REQUEST['card_csv']) ? $_REQUEST['card_csv'] : '';
$check_code = isset($_REQUEST['check_code']) ? $_REQUEST['check_code'] : '';
$total = isset($_REQUEST['total']) ? (int) $_REQUEST['total'] : 0;

function checkTerm($value): bool {
    if(!preg_match("/^([0-9]{2})\/([0-9]{2})$/i", $value, $m))
        return false;
    $month = (int) $m[1];
    if(($month > 12) || ($month < 1))
        return false;
    $year = 2000 + (int) $m[2];
    if($month == 12) {
        $month = 1;
        $year++;
    }
    else {
        $month++;
    }
    $expired = mktime(0, 0, 0, $month, 1, 2000 + (int) $m[2])-3600*24;
    $now = mktime(0, 0, 0);

    return ($now <= $expired);
}

sleep($sleep);

if($cmd == 'input') {
    if($total <= 0)
        $result['message'] = 'Неверно задана сумма платежа';
    elseif(!preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/i", $card_number))
        $result['message'] = 'Неверный номер карты';
    elseif(!checkTerm($card_term))
        $result['message'] = 'Указанная карта просрочена';
    else {
        $nlchar = (int) substr($card_number, -1, 1);
        if(!strlen($card_person) || !preg_match("/[0-9]{3}/i", $card_csv) || ($nlchar % 2 == 1))
            $result['message'] = 'Ошибка проведения платежа. Проверьте введенный номер карты, плательщика и код CSV';
        else {
            $result['status'] = 'success';
            $result['message'] = 'Данные проверены успешно';
        }
    }
}

if($cmd == 'check') {
    if(strcmp($check_code, $rightSmsCode) == 0) {
        $result['status'] = 'success';
        $result['message'] = 'Проверка прошла успешно. Платеж на сумму '.$total.' руб. принят';
    }
    else {
        $result['message'] = 'Введен неверный проверочный код';
    }
}

header("Content-type: application/json; charset=utf-8");
echo json_encode($result);
