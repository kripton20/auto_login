<?php
//$user = 'ocik@niiemp.local';
//$pass = 'ocik1905niiemp';
//$url = 'http://http://localhost / rc147 / ?_task = login';
$user     = 'l51@niiemp.local';
$pass     = 'l51v6249niiemp';
$url      = 'http://localhost/rc147/';

// Создаём новый ресурс cURL (дескриптор cURL).
$ch       = curl_init();

// установка URL и других соответствующих параметров
$opt_auth = array(
    CURLOPT_POST          => true,
    CURLOPT_POSTFIELDS    =>'_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass,
    CURLOPT_COOKIEJAR     => 'cookies.txt',
    CURLOPT_COOKIEFILE    => 'cookies.txt',
    CURLOPT_RETURNTRANSFER=> true,
    CURLOPT_URL           => $url,
    CURLOPT_HEADER=> true
);

curl_setopt_array($ch, $opt_auth);

// Выполняем запрос curl.
$response1=curl_exec($ch);

// Получаем токен.
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response1, $token);

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers = array
(
    // Принимаемые типы данных.
    'Accept: text/html',//,application / xhtml + xml,application / xml;q = 0.9,image / avif,image / webp,image / apng,*/*;q = 0.8,application / signed - exchange;v = b3;q = 0.9;application / json,text / javascript,*/*;q = 0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип передаваемых данных (URL - кодированные данные).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    'Referer: '. $_SERVER['HTTP_HOST'],
    'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'Sec-Ch-Ua-Mobile: ?0',
    'Sec-Ch-Ua-Platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Requested-With: XMLHttpRequest',
    'X-Compress: null',
);

// Отправляем POST - запрос с указанием команды.
// установка URL и других соответствующих параметров
$opt_msg_request = array(
    CURLOPT_POST          => true,
    CURLOPT_COOKIEFILE    =>'cookies.txt',
    CURLINFO_HEADER_OUT   => true,
    CURLOPT_HTTPHEADER    => $headers,
    CURLOPT_RETURNTRANSFER=> true,
    CURLOPT_VERBOSE       => true,
    CURLINFO_HEADER_OUT   => true,
    CURLOPT_NOBODY        => true,
    CURLOPT_HEADER        => true,
    CURLOPT_URL           => $url . '?_task=mail&_action=plugin.msg_request',
    CURLOPT_POSTFIELDS    => '_remote=1&_unlock=0'
);

curl_setopt_array($ch, $opt_msg_request);

// Выполняем запрос curl.
$response3 = curl_exec($ch);

// Преобразуем строку $content в массив
$response3 = explode("\r\n", $response3);

$curl_info3= curl_getinfo($ch);

// установка URL и других соответствующих параметров
$opt_logout= array(
    CURLOPT_HTTPGET       => true,
    CURLOPT_COOKIEFILE    => 'cookies.txt',
    CURLOPT_REFERER       => 'http://localhost/rc147/?_task=mail',
    CURLOPT_RETURNTRANSFER=> true,
    CURLOPT_URL           => $url . '?_task=logout&_token=' . $token[1]
);

curl_setopt_array($ch, $opt_logout);

// Выполняем запрос curl.
curl_exec($ch);

// Зарываем дескриптор.
curl_close($ch);
?>
