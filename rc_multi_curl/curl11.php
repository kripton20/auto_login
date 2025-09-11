<?php
// Логин и пароль.
$user = 'ocik@niiemp.local';
$pass = 'ocik1905niiemp';
//$user     = 'l51@niiemp.local';
//$pass     = 'l51v6249niiemp';
$timezone = 'Europe/Moscow';

$url_1    = 'http://localhost/rc147/';
$url_2    = 'http://localhost/rc147_1/';
//$url_3    = 'http://localhost/rc147_2/';
//$url_1    = 'http://cadmail:10002/rc147-14/';
//$url_2    = 'http://cadmail:10002/rc147-15/';
$url_3    = 'http://cadmail:10002/rc147-1/';

// Создаём новые ресурсы cURL (дескрипторы cURL).
$ch_1     = curl_init();
$ch_2     = curl_init();
$ch_3     = curl_init();

// Установка URL и других соответствующих параметров.
curl_setopt($ch_1, CURLOPT_POST, 1);
curl_setopt($ch_1, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
curl_setopt($ch_1, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_1, CURLOPT_URL, $url_1);
curl_setopt($ch_1, CURLOPT_HEADER, true);

curl_setopt($ch_2, CURLOPT_POST, 1);
curl_setopt($ch_2, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
curl_setopt($ch_2, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_2, CURLOPT_URL, $url_2);
curl_setopt($ch_2, CURLOPT_HEADER, true);

curl_setopt($ch_3, CURLOPT_POST, 1);
curl_setopt($ch_3, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
curl_setopt($ch_3, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_3, CURLOPT_URL, $url_3);
curl_setopt($ch_3, CURLOPT_HEADER, true);

//создаём набор дескрипторов cURL
$mh = curl_multi_init();

//добавляем дескрипторы
$m1=curl_multi_add_handle($mh, $ch_1);
$m2=curl_multi_add_handle($mh, $ch_2);
$m3=curl_multi_add_handle($mh, $ch_3);

// Выполняем запрос curl.
// Запускаем множественный обработчик.
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

// Запросы выполнены, теперь мы можем получить доступ к результатам
$headers_ch = curl_multi_getcontent($ch_1);
$headers_mh = curl_multi_getcontent($mh);
echo "headers_1";
echo $headers_1;
echo "";
$headers_2 = curl_multi_getcontent($ch_2);
$headers_3 = curl_multi_getcontent($ch_3);

// Получаем токен.
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response_1, $token_1);
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response_2, $token_2);
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response_3, $token_3);

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers = array
(
    // Принимаемые типы данных.
    'Accept: text/html',
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

// Отправляем POST-запрос с указанием команды.
// Установка URL и других соответствующих параметров.
curl_setopt($ch_1, CURLOPT_POST, true);
curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_1, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_1, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_1, CURLOPT_VERBOSE, true);
//curl_setopt($ch_1, CURLOPT_NOBODY, true);
curl_setopt($ch_1, CURLOPT_HEADER, true);
curl_setopt($ch_1, CURLOPT_URL, $url_1 . '?_task=mail&_action=plugin.msg_request');
curl_setopt($ch_1, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

curl_setopt($ch_2, CURLOPT_POST, true);
curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_2, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_2, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_2, CURLOPT_VERBOSE, true);
//curl_setopt($ch_2, CURLOPT_NOBODY, true);
curl_setopt($ch_2, CURLOPT_HEADER, true);
curl_setopt($ch_2, CURLOPT_URL, $url_2 . '?_task=mail&_action=plugin.msg_request');
curl_setopt($ch_2, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

curl_setopt($ch_3, CURLOPT_POST, true);
curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_3, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_3, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_3, CURLOPT_VERBOSE, true);
//curl_setopt($ch_3, CURLOPT_NOBODY, true);
curl_setopt($ch_3, CURLOPT_HEADER, true);
curl_setopt($ch_3, CURLOPT_URL, $url_3 . '?_task=mail&_action=plugin.msg_request');
curl_setopt($ch_3, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

// Создаём набор дескрипторов cURL
$mh = curl_multi_init();

// Добавляем дескрипторы
curl_multi_add_handle($mh, $ch_1);
curl_multi_add_handle($mh, $ch_2);
curl_multi_add_handle($mh, $ch_3);

// Выполняем запрос curl.
// Запускаем множественный обработчик.
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

// Запросы выполнены, теперь мы можем получить доступ к результатам
$page_1 = curl_multi_getcontent($ch_1);
echo "page_1";
echo $page_1;
echo "";
$page_2 = curl_multi_getcontent($ch_2);
$page_3 = curl_multi_getcontent($ch_3);

// Установка URL и других соответствующих параметров.
curl_setopt($ch_1, CURLOPT_HTTPGET, true);
curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_1, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_1, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_1, CURLOPT_URL, $url_1 . '?_task=logout&_token=' . $token_1[1]);

curl_setopt($ch_2, CURLOPT_HTTPGET, true);
curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_2, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_2, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_2, CURLOPT_URL, $url_2 . '?_task=logout&_token=' . $token_2[1]);

curl_setopt($ch_3, CURLOPT_HTTPGET, true);
curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch_3, CURLINFO_HEADER_OUT, true);
curl_setopt($ch_3, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_3, CURLOPT_URL, $url_3 . '?_task=logout&_token=' . $token_3[1]);

// Создаём набор дескрипторов cURL
$mh = curl_multi_init();

// Добавляем дескрипторы
curl_multi_add_handle($mh, $ch_1);
curl_multi_add_handle($mh, $ch_2);
curl_multi_add_handle($mh, $ch_3);

// Выполняем запрос curl.
// Запускаем множественный обработчик.
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

// Закрываем все дескрипторы.
curl_multi_remove_handle($mh, $ch_1);
curl_multi_remove_handle($mh, $ch_2);
curl_multi_remove_handle($mh, $ch_3);
curl_multi_close($mh);
?>
