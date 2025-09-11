<?php
/**
* curl_setopt -- устанавливает параметр для сеанса CURL
* Описание: https://www.php.net/manual/ru/function.curl-setopt.php
*/
// Логин/пароль и ссылка н ресурс.
$user = "l51@niiemp.local";
$pass = "l51v6249niiemp";
$url      = "http://localhost/rc147/?_task=login";
//$url = "http://cadmail:10002 / rc147 - 1 / ";

// Создаём дескриптор cURL.
$ch       = curl_init($url);

// В режиме POST - запрос / forum/..
curl_setopt($ch, CURLOPT_POST, 1);

// User - Agent
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla / 5.0 (бла бла бла..)');

$headers  = array
(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Encoding: gzip, deflate',
    'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7'
);

// добавляем заголовков к нашему запросу. Чтоб смахивало на настоящих
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// POST - данные:// Умная libcurl сама добавит заголовки.// Content - Type: application / x - www - form - urlencoded и Content - Length: 71
curl_setopt($ch, CURLOPT_POSTFIELDS, '?_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);

// Параметры cookiejar и cookiefile:
// Когда сервер выдает нам куки, то есть наклейку - Ты такой - то, он потом смотрит на эту наклейку и вспоминает тебя.
// Но нам для этого разумеется нужно обращаться к серверу когда наклейка у нас висит на видном месте.
// Библиотека libcurl может за нас сохранять наклейку в файл, если мы его укажем в параметре cookiejar и также
// посылать куки, то есть обращаться вместе с наклейкой, если мы укажем файл в котором эту наклейку мы сохранили cookiefile.
// А так как нужно было для авторизации чтоб сервер запомнил что мы, это мы при следующем обращение, то на самом деле нужно было просто получить при авторизации куки. Поэтому вот как мы это сделаем.// Также установлен параметр - без тела (nobody) который говорит что весь html нам не нужен, нужны только заголовки. На самом деле его там и нет, но это только в нашем случае. На самом деле скрипт может и проводить авторизацию и ругаться в одном флаконе.
/**
* CURLOPT_COOKIEFILE
* Имя файла, содержащего cookies. Данный файл должен быть в формате Netscape или просто заголовками HTTP, записанными в файл.
* Если в качестве имени файла передана пустая строка, то cookies сохраняться не будут, но их обработка всё ещё будет включена.
* CURLOPT_COOKIEJAR
* Имя файла, в котором будут сохранены все внутренние cookies текущей передачи после закрытия дескриптора,
* например, после вызова curl_close.
*/
curl_setopt($ch, CURLOPT_COOKIEJAR, 'my_cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');

// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//// true для исключения тела ответа из вывода. Метод запроса устанавливается в HEAD.
//// Смена этого параметра в false не меняет его обратно в GET.
////$a8 = curl_setopt($ch, CURLOPT_NOBODY, 1);
//
// true для вывода дополнительной информации.
// Записывает вывод в поток STDERR, или файл, указанный параметром CURLOPT_STDERR.
curl_setopt($ch, CURLOPT_VERBOSE, 1);

// вы можете увидеть информацию о передаче дела перед запросом
// здесь все, что вам нужно:// enable tracking
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

// вы также можете использовать CURLOPT_HEADER в своем curl_setopt
curl_setopt($ch, CURLOPT_HEADER, 1);

// Выполняем запрос curl.
$response1 = curl_exec($ch);

/**
* curl_getinfo — Возвращает информацию об определённой операции.
* Описание:
* curl_getinfo(CurlHandle $handle, int $option=null):mixed
* Возвращает информацию о последней операции.
*/
$curl_info1= curl_getinfo($ch);

// получаем Токен
preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $response1, $token);

// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=mail&_token=' . $token[1]);

// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=login');
// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

$rcPath    = "http://localhost/rc147/";

// Перенаправление на страницу указанную в переменной "rcPath".
header("Location: {$rcPath}");

// Выполняем запрос curl.
$response2 = curl_exec($ch);

// после обращения
$curl_info2= curl_getinfo($ch);

// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=settings&_token=' . $token[1]);

// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

//$rcPath    = "http://localhost/rc147/";

// Перенаправление на страницу указанную в переменной "rcPath".
//header("Location: {$rcPath}");

// Выполняем запрос curl.
$response3 = curl_exec($ch);

// после обращения
$curl_info3= curl_getinfo($ch);

// Указание выполнить команду plugin.msg_request.
// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=mail&_action=plugin.msg_request'); //&_token=' . $token[1]

// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/');
// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

// Выполняем запрос curl.
$response4 = curl_exec($ch);

// после обращения
$curl_info4= curl_getinfo($ch);

// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=mail'); //?_task = mail & _action = plugin.msg_request & _token = ' . $token[1]
// "POST /rc147/?_task=mail&_action=plugin.msg_request HTTP/1.1" 200 473 "http://localhost/rc147/?_task=mail&_mbox=INBOX"
//$ch        = curl_init('http://localhost/rc147/plugins/rm_duplicate_messages/MyExemples/curl/test_request.php?GET=test_get');

// Загоовки из моего запроса
// - создаём запрос "POST" с заданными параметрами.
// Переменной "headers1" присвоим заголовки POST - запроса.
$headers1  = array
(
    // Принимаемые типы данных.
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9;application/json,text/javascript,*/*;q=0.01',
    'Accept-Encoding: gzip,deflate,br',
    'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
    //Accept - Charset: utf - 8,windows - 1251;q = 0.7, * ;q = 0.7',

    'Cache-Control: no-cache,must-revalidate',

    

    //Content - Length: ' . strlen($postData),
    // Тип данных (данные из формы).
    'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',


    'Host: '. $_SERVER['HTTP_HOST'],
    'Origin: '. $_SERVER['HTTP_HOST'],
    'Pragma: no-cache',
    'Referer: http://localhost/rc147/?_task=mail',

    'sec-ch-ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',

    'Sec-Fetch-Dest: empty',
    //Sec - Fetch - Dest: document',
    'Sec-Fetch-Mode: cors',
    //'Sec - Fetch - Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    //'Sec - Fetch - Site: none',
    //Sec - Fetch - User: ?1',

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
    
    // Закрываем соединение.
    //'Connection: keep-alive',
    'Connection: close' . "\r\n\r\n"
);

// В режиме POST - запрос / forum/..
//curl_setopt($ch, CURLOPT_POST, 1); // POST
//curl_setopt($ch, CURLOPT_HTTPGET, 1); //GET
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
// добавляем заголовков к нашему запросу. Чтоб смахивало на настоящих
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);

// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// POST - данные:
/**
* CURLOPT_POSTFIELDS
* Все данные, передаваемые в HTTP POST-запросе.
* Этот параметр может быть передан как в качестве url-закодированной строки, наподобие 'para1=val1&para2=val2&...',
* так и в виде массива, ключами которого будут имена полей, а значениями - их содержимое. Если value является
* массивом, заголовок Content-Type будет установлен в значение multipart/form-data. Файлы можно отправлять с
* использованием CURLFile или CURLStringFile, в этом случае value должен быть массивом.
*/
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0'); //_remote=1&_unlock=0 _action=plugin.msg_request
//curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0&_action=plugin.msg_request');
curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=mail&_action=plugin.msg_request');
//curl_setopt($ch, CURLOPT_POSTFIELDS, '/rc147/?_task=mail&_action=plugin.msg_request');
// "POST /rc147/?_task=mail&_action=plugin.msg_request HTTP/1.1" 200 473 "http://localhost/rc147/?_task=mail&_mbox=INBOX"

curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

//$post_request = [
//     //'firstName' => 'John',
//     //'lastName' => 'Doe',
//     '_action' => 'plugin.msg_request'
//];
//
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
//     CURLOPT_RETURNTRANSFER => true
//];
//
// Создаём дескриптор cURL.
//$ch = curl_init();
//curl_setopt_array($ch, $curlOptions);

// Выполняем запрос curl.
$response5 = curl_exec($ch);

// после обращения
$curl_info5= curl_getinfo($ch);

// Выход
// Создаём дескриптор cURL.
$ch        = curl_init('http://localhost/rc147/?_task=logout&_token=' . $token[1]); //&_token=' . $token[1]

// Отправим GET - запрос на другую страницу этого сайта с имеющимися куками.
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'my_cookies.txt');
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail&_mbox=INBOX');
// Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);

// Выполняем запрос curl.
$response6 = curl_exec($ch);

// после обращения
$curl_info6= curl_getinfo($ch);

// Закрываем (удаляем) дескриптор (ресурс).
curl_close($ch);
?>
