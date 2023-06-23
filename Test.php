<?
$url="https://t.me";
$http="https://";

// Вывод — Слово "лет" есть в данной строке.
if (strpos($url, $http) !== false) {
  echo '<br>Слово "'.$http.'" есть в данной строке.';
}else{
    echo '<br>Слово "'.$http.'" НЕТ в данной строке.';
}
