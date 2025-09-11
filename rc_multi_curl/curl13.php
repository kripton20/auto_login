<?php
// Логин и пароль.
//$user = 'ocik@niiemp.local';
//$pass = 'ocik1905niiemp';
$user     = 'l51@niiemp.local';
$pass     = 'l51v6249niiemp';
$timezone = 'Europe/Moscow';

// Сделать всё в цикле. Перебираем и пдставляем - сколько хостов столько и проходов.
$urls = Array(
    'http://localhost/rc147/',
    'http://localhost/rc147_1/',
    'http://localhost/rc147_2/',
    'http://cadmail:10002/rc147-1/'
);

$mh = curl_multi_init();

foreach ($urls as $url) {
    //$chs[] = ( $ch = curl_init() );
    $ch = curl_init();

    //    curl_setopt($ch, CURLOPT_URL, $url );
    //    curl_setopt($ch, CURLOPT_HEADER, 0 );
    //    // CURLOPT_RETURNTRANSFER - возвращать значение как результат функции, а не выводить в stdout
    //    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

    // Установка URL и других соответствующих параметров.
    curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url . '?_task=login');
    curl_setopt($ch, CURLOPT_HEADER, true);

    // Создаём массив дескрипторов cURL.
    $aCurlHandles[$url] = $ch;

    curl_multi_add_handle($mh, $ch);
}

//// В цикле опираясь на массив "$urls" выполняем все операции.
//foreach ($urls     as $id => $url) {
//    // Создаём новые ресурсы cURL (дескрипторы cURL).
//    $curls[$id] = curl_init();
//
//    // Установка URL и других соответствующих параметров.
//    //    $a1 = curl_setopt($curls[$id], CURLOPT_POST, 1);
//    //    $a2 = curl_setopt($curls[$id], CURLOPT_POSTFIELDS, '_task = login & _action = login & _timezone = Europe / Moscow & _url=&_user = ' . $user . ' & _pass = ' . $pass);
//    //    $a3 = curl_setopt($curls[$id], CURLOPT_COOKIEJAR, 'cookies.txt');
//    //    $a4 = curl_setopt($curls[$id], CURLOPT_COOKIEFILE, 'cookies.txt');
//    //    $a5 = curl_setopt($curls[$id], CURLOPT_RETURNTRANSFER, true);
//    //    //$a6 = curl_setopt($curls[$id], CURLOPT_URL, $curls[$id]);
//    $a6 = curl_setopt($curls[$id], CURLOPT_URL, 'http://localhost / rc147 / ');
//    //    $a7 = curl_setopt($curls[$id], CURLOPT_HEADER, true);
//
//    // Добавляем дескрипторы работающие параллельно.
//    $b1 = curl_multi_add_handle($mh, $curls[$id]);
////    foreach ($curls as $k => $v) {
////        $res = $v;
////    }
//    $b1 = curl_multi_add_handle($mh, $res);
//}
//$b1 = curl_multi_add_handle($mh, $curls[$id]);

// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов. Инициализируем переменную.
//$prev_running = $running = null;
$running = null;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    curl_multi_exec($mh, $running);
    //if ($running != $prev_running) {
    if ($running) {
        //if ($running) {
        // получаю информацию о текущих соединениях
        $info = curl_multi_info_read($mh);
        //if (is_array($info) && ($ch = $info['handle'])) {
        /**
        * curl_multi_select — Ждёт активности на любом curl_multi соединении.
        * Описание:
        * curl_multi_select(CurlMultiHandle $multi_handle, float $timeout=1.0):int
        * Блокирует выполнение скрипта, пока какое-либо из соединений curl_multi не станет активным.
        * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
        * @var timeout      Время в секундах для ожидания ответа.
        * Возвращаемые значения:
        * В случае успеха возвращает количество дескрипторов, содержащихся в наборах дескрипторов.
        * Может вернуть 0, если не было активности ни на одном дескрипторе. В случае неудачи эта функция
        * вернёт -1 при ошибке выборки (из нижележащего системного вызова выборки).
        */
        curl_multi_select($mh);
        // получаю содержимое загруженной страницы
        $content = curl_multi_getcontent($ch);
        // тут какая - то обработка текста страницы
        // пока пусть будет как и в оригинале - вывод в STDOUT
        //echo $content;
        //}
        //}
        // обновляю кешируемое число текущих активных соединений
        //$prev_running = $running;
    }
} while ($running);

// Запросы выполнены, теперь мы можем получить доступ к результатам:
// Перебираем дескрипторы и получаем содержимое страниц (заголовков).
foreach ($aCurlHandles as $url=>$ch) {
    // Получаем заголовки:
    // curl_multi_getcontent — Возвращает результат операции, если была установлена опция CURLOPT_RETURNTRANSFER.
    // Если для определённого дескриптора была установлена опция CURLOPT_RETURNTRANSFER,
    // то эта функция вернёт содержимое этого cURL - дескриптора в виде строки.
    $headers = curl_multi_getcontent($ch);
    echo "headers";
    echo $headers;
    // Получаем токен.
    preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $headers, $token);
    // Запишем в массив "$tokens" полученные токены.
    $tokens[$url] = $token['1'];
}

//do {
//    $status = curl_multi_exec($mh, $active);
//    if ($active) {
//        // Ждём какое - то время для оживления активности
//        curl_multi_select($mh);
//    }
//} while ($active);

//$x1 = 1;
//$url_1 = 'http://localhost / rc147 / ';
//$url_2 = 'http://localhost / rc147_1 / ';
//$url_3 = 'http://localhost / rc147_2 / ';
//
//// Создаём новые ресурсы cURL (дескрипторы cURL).
//$ch_1 = curl_init();
//$ch_2 = curl_init();
//$ch_3 = curl_init();
//
//// Установка URL и других соответствующих параметров.
//curl_setopt($ch_1, CURLOPT_POST, 1);
//curl_setopt($ch_1, CURLOPT_POSTFIELDS, '_task = login & _action = login & _timezone = Europe / Moscow & _url=&_user = ' . $user . ' & _pass = ' . $pass);
//curl_setopt($ch_1, CURLOPT_COOKIEJAR, 'cookies.txt');
//curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_1, CURLOPT_URL, $url_1);
//curl_setopt($ch_1, CURLOPT_HEADER, true);
//
//curl_setopt($ch_2, CURLOPT_POST, 1);
//curl_setopt($ch_2, CURLOPT_POSTFIELDS, '_task = login & _action = login & _timezone = Europe / Moscow & _url=&_user = ' . $user . ' & _pass = ' . $pass);
//curl_setopt($ch_2, CURLOPT_COOKIEJAR, 'cookies.txt');
//curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_2, CURLOPT_URL, $url_2);
//curl_setopt($ch_2, CURLOPT_HEADER, true);
//
//curl_setopt($ch_3, CURLOPT_POST, 1);
//curl_setopt($ch_3, CURLOPT_POSTFIELDS, '_task = login & _action = login & _timezone = Europe / Moscow & _url=&_user = ' . $user . ' & _pass = ' . $pass);
//curl_setopt($ch_3, CURLOPT_COOKIEJAR, 'cookies.txt');
//curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_3, CURLOPT_URL, $url_3);
//curl_setopt($ch_3, CURLOPT_HEADER, true);
//
////создаём набор дескрипторов cURL
//$mh = curl_multi_init();
//
////добавляем дескрипторы
//curl_multi_add_handle($mh, $ch_1);
//curl_multi_add_handle($mh, $ch_2);
//curl_multi_add_handle($mh, $ch_3);
//
//// Выполняем запрос curl.
//// Запускаем множественный обработчик.
//do {
//    $status = curl_multi_exec($mh, $active);
//    if ($active) {
//        curl_multi_select($mh);
//    }
//} while ($active && $status == CURLM_OK);
//
//// все наши запросы выполнены, теперь мы можем получить доступ к результатам
//$response_1 = curl_multi_getcontent($ch_1);
//$response_2 = curl_multi_getcontent($ch_2);
//$response_3 = curl_multi_getcontent($ch_3);
//
//// Получаем токен.
//preg_match('/^Location:\s\.\ / \?_task = mail & _token = ([A - Za - z0 - 9] + )[ ^ \\n] / im', $response_1, $token_1);
//preg_match('/^Location:\s\.\ / \?_task = mail & _token = ([A - Za - z0 - 9] + )[ ^ \\n] / im', $response_2, $token_2);
//preg_match('/^Location:\s\.\ / \?_task = mail & _token = ([A - Za - z0 - 9] + )[ ^ \\n] / im', $response_3, $token_3);

//
//foreach ($urls as $url) {
//
//    $ch      = curl_init();
//    // Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
//    $headers = array
//    (
//        // Принимаемые типы данных.
//        'Accept: text/html',
//        'Accept-Encoding: gzip,deflate,br',
//        'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
//        'Accept-Charset: utf-8,windows-1251;q=0.7,*;q=0.7',
//        'Cache-Control: no-cache,must-revalidate',
//        // Тип передаваемых данных (URL - кодированные данные).
//        'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
//        'Host: '. $_SERVER['HTTP_HOST'],
//        'Origin: '. $_SERVER['HTTP_HOST'],
//        'Pragma: no-cache',
//        'Referer: '. $_SERVER['HTTP_HOST'],
//        'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
//        'Sec-Ch-Ua-Mobile: ?0',
//        'Sec-Ch-Ua-Platform: "Windows"',
//        'Sec-Fetch-Dest: empty',
//        'Sec-Fetch-Mode: cors',
//        'Sec-Fetch-Site: same-origin',
//        'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
//        // Отключим браузерное кэширование.
//        'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
//        'Last-Modified: ' . gmdate("D, dMYH:i:s") . ' GMT',
//        'Cache-Control: post-check=0,pre-check=0',
//        'Cache-Control: max-age=0',
//        'Upgrade-Insecure-Requests: 1',
//        'X-Requested-With: XMLHttpRequest',
//        'X-Roundcube-Request: ' . $tokens[$url],
//        'X-Compress: null',
//    );
//    $t = $tokens[$url];
//
//    // Отправляем POST - запрос с указанием команды.
//    // Установка URL и других соответствующих параметров.
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
//    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_VERBOSE, true);
//    //curl_setopt($ch, CURLOPT_NOBODY, true);
//    curl_setopt($ch, CURLOPT_HEADER, true);
//    curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');
//    curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
//
//    // Создаём массив дескрипторов cURL.
//    $aCurlHandles[$url] = $ch;
//
//    curl_multi_add_handle($mh, $ch);
//}
//
//// Выполняем запросы curl:
//// Переменная "$running" показывает число работающих процессов. Инициализируем переменную.
////$prev_running = $running = null;
//$running = null;
//
//// Запускаем множественный обработчик:
//// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
//// Пока они есть - продолжаем выполнять запросы.
//do {
//    curl_multi_exec($mh, $running);
//    if ($running) {
//        curl_multi_select($mh);
//    }
//} while ($running);
//
//// Запросы выполнены, теперь мы можем получить доступ к результатам:
//// Перебираем дескрипторы и получаем содержимое страниц (заголовков).
//foreach ($aCurlHandles as $url=>$ch) {
//    // Закоментировать.
//    $page = curl_multi_getcontent($ch);
//    echo $page;
//    // Закрываем все дескрипторы.
//    curl_multi_remove_handle($mh, $ch);
//}
//$x = 1;
//// Отправляем POST - запрос с указанием команды.
//// Установка URL и других соответствующих параметров.
//curl_setopt($ch_1, CURLOPT_POST, true);
//curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_1, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_1, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_1, CURLOPT_VERBOSE, true);
//curl_setopt($ch_1, CURLOPT_NOBODY, true);
//curl_setopt($ch_1, CURLOPT_HEADER, true);
//curl_setopt($ch_1, CURLOPT_URL, $url_1 . '?_task = mail & _action = plugin.msg_request');
//curl_setopt($ch_1, CURLOPT_POSTFIELDS, '_remote = 1 & _unlock = 0');
//
//curl_setopt($ch_2, CURLOPT_POST, true);
//curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_2, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_2, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_2, CURLOPT_VERBOSE, true);
//curl_setopt($ch_2, CURLOPT_NOBODY, true);
//curl_setopt($ch_2, CURLOPT_HEADER, true);
//curl_setopt($ch_2, CURLOPT_URL, $url_2 . '?_task = mail & _action = plugin.msg_request');
//curl_setopt($ch_2, CURLOPT_POSTFIELDS, '_remote = 1 & _unlock = 0');
//
//curl_setopt($ch_3, CURLOPT_POST, true);
//curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_3, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_3, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_3, CURLOPT_VERBOSE, true);
//curl_setopt($ch_3, CURLOPT_NOBODY, true);
//curl_setopt($ch_3, CURLOPT_HEADER, true);
//curl_setopt($ch_3, CURLOPT_URL, $url_3 . '?_task = mail & _action = plugin.msg_request');
//curl_setopt($ch_3, CURLOPT_POSTFIELDS, '_remote = 1 & _unlock = 0');
//
//// Создаём набор дескрипторов cURL
//$mh = curl_multi_init();
//
//// Добавляем дескрипторы
//curl_multi_add_handle($mh, $ch_1);
//curl_multi_add_handle($mh, $ch_2);
//curl_multi_add_handle($mh, $ch_3);
//
//// Выполняем запрос curl.
//// Запускаем множественный обработчик.
//do {
//    $status = curl_multi_exec($mh, $active);
//    if ($active) {
//        curl_multi_select($mh);
//    }
//} while ($active && $status == CURLM_OK);

foreach ($urls as $id=>$url ) {
    //$chs[] = ( $ch = curl_init() );
    $ch = curl_init();

    // Установка URL и других соответствующих параметров.
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    //curl_setopt($ch, CURLOPT_REFERER, 'http://localhost / rc147 / ?_task = mail');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url . '?_task=logout&_token=' . $tokens[$url]);
    //$t = $tokens[$url];
    //$t = var_dump($tokens);
    //echo var_dump($tokens);

    // Создаём массив дескрипторов cURL.
    $aCurlHandles[$url] = $ch;

    curl_multi_add_handle($mh, $ch);
}

#######################################################
// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов. Инициализируем переменную.
//$prev_running = $running = null;
$running = null;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    curl_multi_exec($mh, $running);
    if ($running) {
        curl_multi_select($mh);
        
        //curl_multi_remove_handle($mh, $ch);
    }
} while ($running);

// Запросы выполнены, теперь мы можем получить доступ к результатам:
// Перебираем дескрипторы и получаем содержимое страниц (заголовков).
foreach ($aCurlHandles as $url=>$ch) {
    // Закоментировать.
    $page1 = curl_multi_getcontent($ch);
    echo "page1";
    echo $page1;
     // Закрываем все дескрипторы.
     curl_multi_remove_handle($mh, $ch);
}
#######################################################
//// Установка URL и других соответствующих параметров.
//curl_setopt($ch_1, CURLOPT_HTTPGET, true);
//curl_setopt($ch_1, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_1, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_1, CURLOPT_REFERER, 'http://localhost / rc147 / ?_task = mail');
//curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_1, CURLOPT_URL, $url_1 . '?_task = logout & _token = ' . $token_1[1]);
//
//curl_setopt($ch_2, CURLOPT_HTTPGET, true);
//curl_setopt($ch_2, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_2, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_2, CURLOPT_REFERER, 'http://localhost / rc147 / ?_task = mail');
//curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_2, CURLOPT_URL, $url_2 . '?_task = logout & _token = ' . $token_2[1]);
//
//curl_setopt($ch_3, CURLOPT_HTTPGET, true);
//curl_setopt($ch_3, CURLOPT_COOKIEFILE, 'cookies.txt');
//curl_setopt($ch_3, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch_3, CURLOPT_REFERER, 'http://localhost / rc147 / ?_task = mail');
//curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch_3, CURLOPT_URL, $url_3 . '?_task = logout & _token = ' . $token_3[1]);
//
//// Создаём набор дескрипторов cURL
//$mh = curl_multi_init();
//
//// Добавляем дескрипторы
//curl_multi_add_handle($mh, $ch_1);
//curl_multi_add_handle($mh, $ch_2);
//curl_multi_add_handle($mh, $ch_3);
//
//// Выполняем запрос curl.
//// Запускаем множественный обработчик.
//do {
//    $status = curl_multi_exec($mh, $active);
//    if ($active) {
//        curl_multi_select($mh);
//    }
//} while ($active && $status == CURLM_OK);
//
//// Закрываем все дескрипторы.
//curl_multi_remove_handle($mh, $ch_1);
//curl_multi_remove_handle($mh, $ch_2);
//curl_multi_remove_handle($mh, $ch_3);

curl_multi_close($mh);
?>
