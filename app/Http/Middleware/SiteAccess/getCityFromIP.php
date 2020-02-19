<?php
/*
  Полезные ресурсы :
  1. Мой токен и API(синтаксис curl) для получения данных в формате JSON  : https://dadata.ru/api/detect_address_by_ip/
  2. Проверка валидности возвращаемого JSON-объекта : https://jsonlint.com/
  3. Конвертация curl синтаксиса в PHP : https://incarnate.github.io/curl-to-php/


  Шаг 1 : Исходный запрос в формате curl. Взял с сайта dadata.ru
  curl -X GET \
  -H "Accept: application/json" \
  -H "Authorization: Token 717fec7c4e5cbb81a35820d2e060095fd8b918f3" \
  https://suggestions.dadata.ru/suggestions/api/4_1/rs/detectAddressByIp

  Шаг 2 : Далее скопипастил этот синтаксис сюда https://incarnate.github.io/curl-to-php/, чтобы получить php-код.

  Шаг 3 : Это операции конвертации получаемого объекта JSON в ассоциативный массив, чтобы вытащить свойство 'city'
*/

function getCityFromIP($ip)
{
  $query="https://suggestions.dadata.ru/suggestions/api/4_1/rs/detectAddressByIp?ip=".$ip;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query);

    //curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
    //curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

  $headers = array();
  $headers[] = "Accept: application/json";
  $headers[] = "Authorization: Token 717fec7c4e5cbb81a35820d2e060095fd8b918f3";//мой токен с dadata.ru
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);//результат = объект JSON. Содержит много свойств/полей, но нам нужно только одно свойство 'city'
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);

  //$result в формате JSON
  $arr = json_decode($result, true);//конвертация JSON => array
  $country=$arr['location']['data']['country'];
  $city=$arr['location']['data']['city'];
  
  if($country!="Россия")
  {
    $city="не Россия";
  }

  return $city;

  // Пошаговый дебаггинг
  // echo "<p>лог для getCityFromIP.php, функция getCityFromIP(...) :</p>";
  // echo "<p>для заданного ip ".$ip."</p>";
  // echo "<p>определил страну как =  ".$country."</p>";
  // echo "<p>определил город как = ".$city."</p>";
}
?>