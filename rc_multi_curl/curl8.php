<?php
//$user = 'ocik@niiemp.local';
//$pass = 'ocik1905niiemp';
//$url = 'http://http://localhost / rc147 / ?_task = login';
$user    = 'l51@niiemp.local';
$pass    = 'l51v6249niiemp';
$url     = 'http://localhost/rc147/';

// Создаём новый ресурс cURL (дескриптор cURL).
$ch      = curl_init();

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookieFileName.txt');
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);

$response1=curl_exec($ch);

if(curl_exec($ch) === false)
{
    echo 'Ошибка curl: ' . curl_error($ch) . "\r\n";
}
else
{
    echo 'Операция авторизации завершена без каких-либо ошибок' . "\r\n";
}

// Запросы выполнены, теперь мы можем получить доступ к результатам.
//$response_1 = curl_getcontent($ch);

// Получаем токен.
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response1, $token);

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers  = array
(
    // Принимаемые типы данных.
    'Accept: text/html', //,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
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

echo "\r\n";
echo var_dump($headers);
echo "\r\n";

// Отправляем POST - запрос с указанием команды.
curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookieFileName.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');
curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

// Заголовки запроса
$curl_info_POST= curl_getinfo($ch);

// Выполняем запрос curl.
$response_POST = curl_exec($ch);

if(curl_exec($ch) === false)
{
    echo 'Ошибка curl: ' . curl_error($ch) . "\r\n";
}
else
{
    echo 'Операция plugin.msg_request завершена без каких-либо ошибок' . "\r\n";
}

// Запросы выполнены, теперь мы можем получить доступ к результатам.
//$page = curl_getcontent($ch);

// Преобразуем строку $content в массив
$response3 = explode("\r\n", $response3);

$curl_info3= curl_getinfo($ch);

#####################################
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookieFileName.txt');
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&token=' . $token['1']);
    $t = $token['1'];
    $patch = $url . '?_task=mail&token=' . $token['1'];

$curl_info_GET= curl_getinfo($ch);
$response_GET=curl_exec($ch);

######################################

curl_setopt($ch, CURLOPT_HTTPGET, 1);
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookieFileName.txt');
//curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url . '?_task=logout&_token=' . $token['1']);

// Выполняем запрос curl.
//$response6 = curl_exec($ch);
//$curl_info6= curl_getinfo($ch);
curl_exec($ch);

// Зарываем дескриптор.
curl_close($ch);
?>
