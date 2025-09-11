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

// В цикле опираясь на массив "$urls" выполняем все операции.
foreach ($urls as $url) {
    // Новая сессия
    $ch = curl_init();
    // Случайное число.
    $cookie_prefix = random_int(1, 100);
    //$cookies[$url] = ' / tmp / cookieFileName' . $cookie_prefix . '.txt';
    $cookies[$url] = 'cookieFileName' . $cookie_prefix . '.txt';
    // Установка URL и других соответствующих параметров.
    curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
    //curl_setopt($ch, CURLOPT_COOKIEJAR, ' / tmp / cookieFileName' . $cookie_prefix . '.txt');
    $cookieFileName = $cookies[$url];
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFileName);
    //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    // CURLOPT_RETURNTRANSFER - возвращать значение как результат функции, а не выводить в stdout
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url . '?_task=login');
    curl_setopt($ch, CURLOPT_HEADER, true);
    // Создаём массив дескрипторов cURL.
    $aCurlHandles[$url] = $ch;
    // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
    curl_multi_add_handle($mh, $ch);

    // Выполняем запросы curl:
    // Переменная "$running" показывает число работающих процессов. Инициализируем переменную.
    $running = null;

    // Запускаем множественный обработчик:
    // curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
    // Пока они есть - продолжаем выполнять запросы.
    do {
        curl_multi_exec($mh, $running);
        if ($running) {
            // получаю информацию о текущих соединениях
            $info          = curl_multi_info_read($mh);
            $curl_info_GET = curl_multi_info_read($mh);
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
            $content       = curl_multi_getcontent($ch);
        }
    } while ($running);

    // Запросы выполнены, теперь мы можем получить доступ к результатам:
    // Перебираем дескрипторы и получаем содержимое страниц (заголовков).
    foreach ($aCurlHandles as $url=>$ch) {
        // Получаем заголовки:
        // curl_multi_getcontent — Возвращает результат операции, если была установлена опция CURLOPT_RETURNTRANSFER.
        // Если для определённого дескриптора была установлена опция CURLOPT_RETURNTRANSFER,
        // то эта функция вернёт содержимое этого cURL - дескриптора в виде строки.
        $headers[$url] = curl_multi_getcontent($ch);
        echo "headers";
        echo $headers;
        // Получаем токен.
        preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $headers, $token);
        // Запишем в массив "$tokens" полученные токены.
        $tokens[$url] = $token['1'];
    }

    ####################################
    //GET - запрос
    foreach ($urls as $url) {
        // Создавать новый сеанс иначе "$running" будет равно - 0.
        //$ch = curl_init($url);

        //$ch = $aCurlHandles[$url];
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, ' / tmp / cookieFileName' . $cookie_prefix . '.txt');
        $cookieFileName = $cookies[$url];
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFileName);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&token=' . $tokens[$url]);
        $t1             = $tokens[$url];
        $patch         = $url . '?_task=mail&token=' . $tokens[$url];
        // Создаём массив дескрипторов cURL.
        //$aCurlHandles[$url] = $ch;
        // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
        curl_multi_add_handle($mh, $ch);

        $curl_info_GET = curl_multi_info_read($mh);
    }

    $running = null;

    do {
        curl_multi_exec($mh, $running);
        if ($running) {
            $curl_info_GET = curl_multi_info_read($mh);
            curl_multi_select($mh);
        }
    } while ($running);

    foreach ($aCurlHandles as $url=>$ch) {
        $response_GET[$url] = curl_multi_getcontent($ch);
        echo "headers_GET";
        echo $headers_GET;
    }
    ####################################

    foreach ($urls as $url) {

        //$ch = curl_init();
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
            'X-Roundcube-Request: ' . $tokens[$url],
            'X-Compress: null',
        );
        $t2 = $tokens[$url];

        // Отправляем POST - запрос с указанием команды.
        // Установка URL и других соответствующих параметров.
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, ' / tmp / cookieFileName' . $cookie_prefix . '.txt');
        $cookieFileName = $cookies[$url];
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFileName);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        //curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');
        curl_setopt($ch, CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
        // Создаём массив дескрипторов cURL.
        $aCurlHandles[$url] = $ch;
        // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
        curl_multi_add_handle($mh, $ch);
    }

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
            $curl_info_POST = curl_multi_info_read($mh);
            curl_multi_select($mh);
        }
    } while ($running);

    // Запросы выполнены, теперь мы можем получить доступ к результатам:
    // Перебираем дескрипторы и получаем содержимое страниц (заголовков).
    foreach ($aCurlHandles as $url=>$ch) {
        // Закоментировать.
        $page_response[$url] = curl_multi_getcontent($ch);
        echo "page_response" . "\n";
        echo $page_response . "\n";
        // Преобразуем строку $content в массив
        $page_response = explode("\r\n", $page_response);
        // Выходные данные в массив
        $pages[$url] = $page_response;
        // Закрываем все дескрипторы.
        //curl_multi_remove_handle($mh, $ch);
    }

    foreach ($urls as $id=>$url ) {
        //$chs[] = ( $ch = curl_init() );
        //$ch = curl_init();

        // Установка URL и других соответствующих параметров.
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, ' / tmp / cookieFileName' . $cookie_prefix . '.txt');
        $cookieFileName = $cookies[$url];
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFileName);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://localhost / rc147 / ?_task = mail');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url . '?_task=logout&_token=' . $tokens[$url]);
        //$t = $tokens[$url];
        //$t = var_dump($tokens);
        //echo var_dump($tokens);
        // Создаём массив дескрипторов cURL.
        $aCurlHandles[$url] = $ch;
        // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
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
            $curl_info_GET = curl_multi_info_read($mh);
            curl_multi_select($mh);
            //curl_multi_remove_handle($mh, $ch);
        }
    } while ($running);

    // Запросы выполнены, теперь мы можем получить доступ к результатам:
    // Перебираем дескрипторы и получаем содержимое страниц (заголовков).
    foreach ($aCurlHandles as $url=>$ch) {
        // Закоментировать.
        $page_aut[$url] = curl_multi_getcontent($ch);
        echo "page_aut";
        echo $page_aut;
        // Закрываем все дескрипторы.
        curl_multi_remove_handle($mh, $ch);
    }
    #######################################################
    // Конец первого цикла
}

curl_multi_close($mh);
?>
