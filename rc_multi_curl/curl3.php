<?php
$user = "l51@niiemp.local";
$pass = "l51v6249niiemp";
$url = "http://localhost/rc147/?_task=login";

// Создаём дескриптор cURL.
$ch       = curl_init($url);
//$headers  = array
//(
//    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
//    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
//    'Accept-Encoding: gzip, deflate',
//    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7'
//);
// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип данных (кодированные данные из формы) в ыормате key1=data1&key2=data2.
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    // В режиме "multipart/form-data" данные отправляются в виде массива "array()" в ыормате 'key1' => 'data1', 'key2' => 'data2'.
    //'Content-Type: multipart/form-data',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    'Referer: http://localhost/rc147/?_task=mail',
    'sec-ch-ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //Sec-Fetch-Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    //'Sec-Fetch-Site: none',
    //Sec-Fetch-User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    'X-Requested-With: XMLHttpRequest',
    //'X-Roundcube-Request: ' . $token[1],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D,dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Compress: null',
//    // Закрываем соединение.
//    'Connection: keep-alive' . "\r\n\r\n"
    //'Connection: close' . "\r\n\r\n"
);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla / 5.0 (бла бла бла..)');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
//С такими данными не авторизует
//curl_setopt($ch, CURLOPT_POSTFIELDS, array(
//    'task' => 'login',
//    'action' => 'login',
//    'timezone' => 'Europe/Moscow',
//    'url' => '',
//    'user' => $user,
//    'pass' => $pass
//));
curl_setopt($ch, CURLOPT_COOKIEJAR, 'my_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
////$a8 = curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$response1 = curl_exec($ch);
$curl_info1= curl_getinfo($ch);

preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response1, $token);// получаем Токен

// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=mail&_token=' . $token[1]);
// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

$rcPath    = "http://localhost/rc147/";
header("Location: {$rcPath}");// Перенаправление на страницу указанную в переменной "rcPath".

$response2 = curl_exec($ch);
$curl_info2= curl_getinfo($ch);

//// Создаём дескриптор cURL.
//$ch        = curl_init('http://localhost/rc147/?_task=settings&_token=' . $token[1]);
//curl_setopt($ch, CURLOPT_HTTPGET, 1);
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
//curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
////$rcPath    = "http://localhost/rc147/";
////header("Location: {$rcPath}");// Перенаправление на страницу указанную в переменной "rcPath".
//$response3 = curl_exec($ch);
//$curl_info3= curl_getinfo($ch);

//// Создаём дескриптор cURL.
//$ch        = curl_init('http://localhost/rc147/?_task=mail'); //&_token=' . $token[1] &_action=plugin.msg_request
//// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
//curl_setopt($ch, CURLOPT_HTTPGET, 1);
//curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
//curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
////curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
////curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
//$response4 = curl_exec($ch);
//$curl_info4= curl_getinfo($ch);

// Указание выполнить команду plugin.msg_request. (этот запрос работает но нам нужен POST-запрос)
// Создаём дескриптор cURL.// "POST /rc147/?_task=mail&_action=plugin.msg_request HTTP/1.1" 200 473 "http://localhost/rc147/?_task=mail&_mbox=INBOX"
$ch        = curl_init('http://localhost/rc147/?_task=mail'); //?_task = mail & _action = plugin.msg_request & _token = ' . $token[1]
// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers1  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип данных (данные из формы).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
//    'Content-Type: multipart/form-data',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    'Referer: http://localhost/rc147/?_task=mail',
    'sec-ch-ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //Sec-Fetch-Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    //'Sec-Fetch-Site: none',
    //Sec-Fetch-User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    'X-Requested-With: XMLHttpRequest',
    'X-Roundcube-Request: ' . $token[1],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D,dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Compress: null',
//    // Закрываем соединение.
//    'Connection: keep-alive' . "\r\n\r\n"
    //'Connection: close' . "\r\n\r\n"
);
// POST-запрос.
curl_setopt($ch, CURLOPT_POST, 1); // POST
//curl_setopt($ch, CURLOPT_HTTPGET, 1); //GET
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// POST-данные:
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0'); //_remote=1&_unlock=0 _action=plugin.msg_request
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0&_action=plugin.msg_request');
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0&_task=mail&_action=plugin.msg_request');
//curl_setopt($ch, CURLOPT_POSTFIELDS, '/rc147/?_task=mail&_action=plugin.msg_request');
// Для HTTP-заголовка 'Content-Type: multipart/form-data' данные посылаются в формате массива "array()".
//curl_setopt($ch, CURLOPT_POSTFIELDS, array(
//    'task' => 'mail',
//    'action' => 'plugin.msg_request'
//));
//curl_setopt($ch, CURLOPT_POSTFIELDS, '?_task=mail&_action=plugin.msg_request');
curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=mail&_action=plugin.msg_request');
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
//curl_setopt($ch, CURLOPT_POSTFIELDS, '?_a=a');

curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

// Выполняем запрос curl.
$response5 = curl_exec($ch);
$curl_info5= curl_getinfo($ch);



//// Этот запрос проверку не проходит
//$post_request = [
//     //'firstName' => 'John',
//     //'lastName' => 'Doe',
//     'remote' => '1',
//     'unlock' => '0',
//     'task' => 'mail',
//     'action' => 'plugin.msg_request'
//];
//$curlOptions = [
//     CURLOPT_URL => 'http://localhost/rc147/?_task=mail',
//     CURLOPT_COOKIEFILE => 'my_cookies.txt',
//     CURLOPT_POST => true,
//     CURLOPT_HEADER => true,
//     CURLOPT_POSTFIELDS => $post_request,
//     CURLOPT_VERBOSE => true,
//     CURLINFO_HEADER_OUT => true,
//     // добавляем заголовков к нашему запросу. Чтоб смахивало на настоящих.
//     CURLOPT_HTTPHEADER, $headers1,
//     CURLOPT_REFERER, 'http://localhost/rc147/',
//     // Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
//     CURLOPT_RETURNTRANSFER => true,
//     
//];
//// Создаём дескриптор cURL.
//$ch = curl_init();
//curl_setopt_array($ch, $curlOptions);
//
//// Выполняем запрос curl.
//$responseO = curl_exec($ch);
//$curl_infoO= curl_getinfo($ch);

// Выход // Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=logout&_token=' . $token[1]); //&_token=' . $token[1]
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$response6 = curl_exec($ch);
$curl_info6= curl_getinfo($ch);

curl_close($ch);
?>
