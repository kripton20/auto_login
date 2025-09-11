<?php
//$user = 'ocik@niiemp.local';
//$pass = 'ocik1905niiemp';
//$url = 'http://http://localhost / rc147 / ?_task = login';
$user    = 'l51@niiemp.local';
$pass    = 'l51v6249niiemp';
$url     = 'http://localhost/rc147/';

// Создаём дескриптор cURL.
// создание нового ресурса cURL
//$ch        = curl_init($url);
$ch        = curl_init();

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип передаваемых данных (URL - кодированные данные).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    //'Referer: http://cadmail:10002 / rc147 - 50 / ?_task = mail',
    'Referer: '. $_SERVER['HTTP_HOST'],
    'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'Sec-Ch-Ua-Mobile: ?0',
    'Sec-Ch-Ua-Platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //'Sec - Fetch - Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec - Fetch - Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    ////'Sec - Fetch - Site: none',
    ////'Sec - Fetch - User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Requested-With: XMLHttpRequest',
    //'X-Roundcube-Request: ' . $token[1],
    //'X-Roundcube-Request: ' . $this->lastToken,
    'X-Compress: null',
);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla / 5.0 (бла бла бла..)');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'my_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url);

$response1 = curl_exec($ch);
//echo($response1);
$curl_info1= curl_getinfo($ch);

// Получаем токен.
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response1, $token);

// Создаём дескриптор cURL.
//$ch        = curl_init();

// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_NOBODY, 1);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_token=' . $token[1]);

$rcPath    = "http://localhost/rc147/";
header("Location: {$rcPath}");// Перенаправление на страницу указанную в переменной "rcPath".

$response2 = curl_exec($ch);
//echo($response2);
$curl_info2= curl_getinfo($ch);

// Указание выполнить команду plugin.msg_request. (этот запрос работает но нам нужен POST - запрос)
// Создаём дескриптор cURL.// "POST / rc147 / ?_task = mail & _action = plugin.msg_request HTTP / 1.1" 200 473 "http://http://localhost / rc147 / ?_task = mail & _mbox = INBOX"
//$ch        = curl_init('http://localhost/rc147/?_task=mail&_action=plugin.msg_request'); //?_task = mail & _action = plugin.msg_request & _token = ' . $token[1]

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers1  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип передаваемых данных (URL - кодированные данные).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    //'Referer: http://cadmail:10002 / rc147 - 50 / ?_task = mail',
    'Referer: '. $_SERVER['HTTP_HOST'],
    'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'Sec-Ch-Ua-Mobile: ?0',
    'Sec-Ch-Ua-Platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //'Sec - Fetch - Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec - Fetch - Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    ////'Sec - Fetch - Site: none',
    ////'Sec - Fetch - User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Requested-With: XMLHttpRequest',
    'X-Roundcube-Request: ' . $token[1],
    //'X-Roundcube-Request: ' . $this->lastToken,
    'X-Compress: null',
);

// Отправляем POST - запрос с указанием команды.
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_NOBODY, true);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');

// POST - данные: В виде URL - кодированной строки.
curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

// Выполняем запрос curl.
$response3 = curl_exec($ch);

// Преобразуем строку $content в массив 
$response3 = explode("\r\n", $response3);

$curl_info3= curl_getinfo($ch);


// Указание выполнить команду plugin.msg_request. (этот запрос работает но нам нужен POST - запрос)
// Создаём дескриптор cURL.// "POST / rc147 / ?_task = mail & _action = plugin.msg_request HTTP / 1.1" 200 473 "http://http://localhost / rc147 / ?_task = mail & _mbox = INBOX"
//$ch        = curl_init('http://localhost/rc147/?_task=mail&_action=plugin.msg_request'); //?_task = mail & _action = plugin.msg_request & _token = ' . $token[1]

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers4  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип передаваемых данных (URL - кодированные данные).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    //'Referer: http://cadmail:10002 / rc147 - 50 / ?_task = mail',
    'Referer: '. $_SERVER['HTTP_HOST'],
    'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'Sec-Ch-Ua-Mobile: ?0',
    'Sec-Ch-Ua-Platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //'Sec - Fetch - Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec - Fetch - Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    ////'Sec - Fetch - Site: none',
    ////'Sec - Fetch - User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Requested-With: XMLHttpRequest',
    'X-Roundcube-Request: ' . $token[1],
    //'X-Roundcube-Request: ' . $this->lastToken,
    'X-Compress: null',
);

// Отправляем POST - запрос с указанием команды.
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers4);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_NOBODY, true);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');

// POST - данные: В виде URL - кодированной строки.
curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

// Выполняем запрос curl.
$response4 = curl_exec($ch);
//echo($response5);
$curl_info4= curl_getinfo($ch);


// Указание выполнить команду plugin.msg_request. (этот запрос работает но нам нужен POST - запрос)
// Создаём дескриптор cURL.// "POST / rc147 / ?_task = mail & _action = plugin.msg_request HTTP / 1.1" 200 473 "http://http://localhost / rc147 / ?_task = mail & _mbox = INBOX"
//$ch        = curl_init('http://localhost/rc147/?_task=mail&_action=plugin.msg_request'); //?_task = mail & _action = plugin.msg_request & _token = ' . $token[1]

// Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
$headers5  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
    'Cache-Control: no-cache,must-revalidate',
    // Тип передаваемых данных (URL - кодированные данные).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    //'Referer: http://cadmail:10002 / rc147 - 50 / ?_task = mail',
    'Referer: '. $_SERVER['HTTP_HOST'],
    'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'Sec-Ch-Ua-Mobile: ?0',
    'Sec-Ch-Ua-Platform: "Windows"',
    'Sec-Fetch-Dest: empty',
    //'Sec - Fetch - Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec - Fetch - Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    ////'Sec - Fetch - Site: none',
    ////'Sec - Fetch - User: ?1',
    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
    // Отключим браузерное кэширование.
    'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
    'Last-Modified: ' . gmdate("D, dMYH:i:s") . ' GMT',
    'Cache-Control: post-check=0,pre-check=0',
    'Cache-Control: max-age=0',
    'Upgrade-Insecure-Requests: 1',
    'X-Requested-With: XMLHttpRequest',
    'X-Roundcube-Request: ' . $token[1],
    //'X-Roundcube-Request: ' . $this->lastToken,
    'X-Compress: null',
);

// Отправляем POST - запрос с указанием команды.
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_NOBODY, true);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');

// POST - данные: В виде URL - кодированной строки.
curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');

// Выполняем запрос curl.
$response5 = curl_exec($ch);
//echo($response5);
$curl_info5= curl_getinfo($ch);

// Выход: Создаём дескриптор cURL.
//$ch        = curl_init('http://localhost/rc147/?_task=logout&_token=' . $token[1]);

curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
// Для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.	
curl_setopt($ch, CURLOPT_HEADER, true);
// Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
curl_setopt($ch, CURLOPT_URL, $url . '?_task=logout&_token=' . $token[1]);

// Выполняем запрос curl.
$response6 = curl_exec($ch);
//echo($response6);
$curl_info6= curl_getinfo($ch);

// Зарываем дескриптор.
curl_close($ch);
?>
