<?php
// Логин и пароль для  доступа на почтовый аккаунт.
//$user = 'ocik@niiemp.local';
//$pass = 'ocik1905niiemp';
$user = 'l51@niiemp.local';
$pass = 'l51v6249niiemp';

// Массив содержит WEB - адреса хостов которые будем обрабатывать.
$urls = Array(
    'http://localhost/rc147/',
    'http://localhost/rc147_1/',
    'http://localhost/rc147_2/',
    'http://cadmail:10002/rc147-14/',
    'http://cadmail:10002/rc147-15/',
    'http://cadmail:10002/rc147-18/'
);

/**
* curl_multi_init — Создаёт набор cURL-дескрипторов.
* curl_multi_init():CurlMultiHandle
* Позволяет асинхронную обработку множества cURL-дескрипторов.
* У этой функции нет параметров.
* Возвращает набор cURL-дескрипторов в случае успешного выполнения или false в случае возникновения ошибки.
*/
// Создаём набор дескрипторов cURL.
$mh = curl_multi_init();

// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
    // Новая сессия    // Для каждого url создаем отдельный curl механизм чтоб посылал запрос)
    $ch[$key] = curl_init();
    // В массив "$cookies" запишем имена куки - файлов.
    $cookies[$key] = 'cookies_' . $key . '.txt';
    // Установка URL и других соответствующих параметров:
    curl_setopt($ch[$key], CURLOPT_POST, true);
    curl_setopt($ch[$key], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key] . '?_task=login');
    curl_setopt($ch[$key], CURLOPT_VERBOSE, true);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, true);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, true);
    curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    // CURLOPT_RETURNTRANSFER - возвращать значение как результат функции, а не выводить в stdout.
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов:
    // Добавляем текущий механизм к числу работающих параллельно.
    curl_multi_add_handle($mh, $ch[$key]);
}

// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов.
// Переменная "$status" показывает отсутствие ошибок. Инициализируем переменные.
$status = $running= NULL;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    /**
    * curl_multi_exec — Запускает подсоединения текущего дескриптора cURL.
    * Описание:
    * curl_multi_exec(CurlMultiHandle $multi_handle, int &$still_running):int
    * Обрабатывает каждый дескриптор в стеке. Этот метод может быть вызван вне зависимости
    * от необходимости дескриптора читать или записывать данные.
    * Список параметров:
    * @var multi_handle  Мультидескриптор cURL, полученный из curl_multi_init().
    * @var still_running Ссылка на флаг, указывающий, идут-ли ещё какие-либо действия.
    * Возвращаемые значения:
    * Код cURL, указанный в предопределённых константах cURL.
    * Замечание:
    * Здесь возвращаются ошибки, относящиеся только ко всему стеку.
    * Проблемы всё ещё могут произойти на индивидуальных запросах, даже когда эта функция возвращает CURLM_OK.
    */
    $status = curl_multi_exec($mh, $running);
    if ($running) {
        /**
        * curl_multi_select — Ждёт активности на любом curl_multi соединении.
        * Описание:
        * curl_multi_select(CurlMultiHandle $multi_handle, float $timeout=1.0):int
        * Блокирует выполнение скрипта, пока какое-либо из соединений curl_multi не станет активным.
        * * Список параметров:
        * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
        * @var timeout      Время в секундах для ожидания ответа.
        * Возвращаемые значения:
        * В случае успеха возвращает количество дескрипторов, содержащихся в наборах дескрипторов.
        * Может вернуть 0, если не было активности ни на одном дескрипторе. В случае неудачи эта функция
        * вернёт -1 при ошибке выборки (из нижележащего системного вызова выборки).
        */
        $ready = curl_multi_select($mh);
        // Проверяем что ответил сервер: код ответа, содержимое страницы (можно использовать в будущем).
        if ($ready > 0) {
            while ($info = curl_multi_info_read($mh)) {
                $getinfo = curl_getinfo($info['handle'],CURLINFO_HTTP_CODE);
                if ($getinfo == 302) {
                    $successUrl = curl_getinfo($info['handle'], CURLINFO_EFFECTIVE_URL);
                }
            }
        }
    }
} while ($running && $status == CURLM_OK);

// В цикле перебираем элементы массива "$ch" получаем содержимое ответа сервера.
foreach ($ch as $key=>$value) {
    /**
    * curl_multi_getcontent — Возвращает результат операции, если была установлена опция CURLOPT_RETURNTRANSFER.
    * Описание:
    * curl_multi_getcontent(CurlHandle $handle):string|null
    * Если для определённого дескриптора была установлена опция CURLOPT_RETURNTRANSFER,
    * то эта функция вернёт содержимое этого cURL-дескриптора в виде строки.
    * Список параметров:
    * @var handle Дескриптор cURL, полученный из curl_init().
    * Возвращаемые значения:
    * Возвращает содержимое cURL-дескриптора, если была использована опция CURLOPT_RETURNTRANSFER.
    */
    // Получаем ответ от сервера.
    $headers1[$key] = curl_multi_getcontent($ch[$key]);
    /**
    * preg_match — Выполняет проверку на соответствие регулярному выражению.
    * Описание:
    * preg_match(string $pattern, string $subject, array &$matches=null, int $flags=0, int $offset=0):int|false
    *
    * Ищет в заданном тексте subject совпадения с шаблоном pattern.
    * Список параметров:
    * @var pattern Искомый шаблон в виде строки.
    * @var subject Входная строка.
    * @var matches В случае, если указан дополнительный параметр matches, он будет заполнен результатами поиска.
    *              Элемент $matches[0] будет содержать часть строки, соответствующую вхождению всего шаблона,
    *              $matches[1] - часть строки, соответствующую первой подмаске и так далее.
    * @var flags   flags может быть комбинацией следующих флагов:
    *              PREG_OFFSET_CAPTURE - В случае, если этот флаг указан, для каждой найденной подстроки будет
    *              указана её позиция (в байтах) в исходной строке. Необходимо помнить, что этот флаг меняет формат
    *              возвращаемого массива matches в массив, каждый элемент которого содержит массив, содержащий в
    *              индексе с номером 0 найденную подстроку, а смещение этой подстроки в параметре subject - в индексе 1.
    *              PREG_UNMATCHED_AS_NULL - Если этот флаг передан, несовпадающие подмаски будут представлены значениями
    *              null; в противном случае они отображаются в виде пустых строк (string).
    * @var offset  Обычно поиск осуществляется слева направо, с начала строки. Можно использовать дополнительный
    *              параметр offset для указания альтернативной начальной позиции для поиска (в байтах).
    * Замечание:
    * Использование параметра offset не эквивалентно замене сопоставляемой строки выражением substr($subject, $offset)
    * при вызове функции preg_match(), поскольку шаблон pattern может содержать такие условия как ^, $ или (?<=x).
    * Возвращаемые значения:
    * preg_match() возвращает 1, если параметр pattern соответствует переданному параметру subject, 0 если нет,
    * или false в случае ошибки.
    */
    // Получаем токен.
    preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $headers1[$key], $token);
    // Запишем в массив "$tokens" полученные токены.
    $tokens[$key] = $token['1'];
    /**
    * curl_multi_remove_handle — Удаляет cURL дескриптор из набора cURL дескрипторов.
    * Описание:
    * curl_multi_remove_handle(CurlMultiHandle $multi_handle, CurlHandle $handle):int
    *
    * Удаляет указанный дескриптор handle из указанного набора дескрипторов multi_handle. После того, как
    * дескриптор handle удалён, его можно снова использовать в функции curl_exec(). Удаление дескриптора handle
    * во время использования также остановит текущую передачу, идущую на этом дескрипторе.
    * Список параметров:
    * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
    * @var handle       Дескриптор cURL, полученный из curl_init().
    * Возвращаемые значения:
    * В случае успеха возвращает 0 или одну из констант CURLM_XXX, где XXX - код ошибки.
    */
    // Закрываем все дескрипторы.
    curl_multi_remove_handle($mh, $ch[$key]);
}

// Сбрасываем все установленные опции.
foreach ($ch as $key=>$value) {
    /**
    * curl_reset — Сбросить все настройки обработчика сессии libcurl.
    * Описание:
    * curl_reset(CurlHandle $handle):void
    *
    * Эта функция переинициализирует все настройки заданного обработчика сессии cURL значениями по умолчанию.
    * Список параметров:
    * @var handle Дескриптор cURL, полученный из curl_init().
    * Возвращаемые значения:
    * Эта функция не возвращает значения после выполнения.
    */
    curl_reset($ch[$key]);
}

#################
// GET - запрос:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $url . '?_task=mail&token=' . $tokens[$key]);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, true);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, true);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, true);
    curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    
    //$t1    = $tokens[$key];
    //$patch = $url . '?_task=mail&token=' . $tokens[$key];
    curl_multi_add_handle($mh, $ch[$key]);
}

// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов.
// Переменная "$status" показывает отсутствие ошибок. Инициализируем переменные.
$status = $running= NULL;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    $status = curl_multi_exec($mh, $running);
    if ($running) {
        curl_multi_select($mh);
    }
} while ($running && $status == CURLM_OK);

// В цикле перебираем элементы массива "$ch" получаем содержимое ответа сервера.
foreach ($ch as $key=>$value) {
    $headers2[$key] = curl_multi_getcontent($ch[$key]);
    //echo "\r\n" . $headers2[$key] . "\r\n";
    curl_multi_remove_handle($mh, $ch[$key]);
}
#################

// Сбрасываем все установленные опции.
foreach ($ch as $key=>$value) {
    curl_reset($ch[$key]);
}

// POST - запрос:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
    // Загоовки из моего запроса// - создаём запрос "POST" с заданными параметрами.// Переменной "headers1" присвоим заголовки POST - запроса.
    $post_headers = array
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
        'X-Roundcube-Request: ' . $tokens[$key],
        'X-Compress: null',
    );
    //$t2 = $tokens[$key];

    // Отправляем POST - запрос с указанием команды.
    // Установка URL и других соответствующих параметров.
    curl_setopt($ch[$key], CURLOPT_POST, true);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, true);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, true);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, true);
    curl_setopt($ch[$key], CURLOPT_HTTPHEADER, $post_headers);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, true);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, true);
    curl_setopt($ch[$key], CURLOPT_HEADER, true);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key] . '?_task=mail&_action=plugin.msg_request');
    curl_setopt($ch[$key], CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
    curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
    curl_multi_add_handle($mh, $ch[$key]);
    //$t1    = $tokens[$key];
    //$patch = $url . '?_task=mail&token=' . $tokens[$key];
}

// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов.
// Переменная "$status" показывает отсутствие ошибок. Инициализируем переменные.
$status = $running= NULL;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    $status = curl_multi_exec($mh, $running);
    if ($running) {
        curl_multi_select($mh);
    }
} while ($running && $status == CURLM_OK);

// В цикле перебираем элементы массива "$ch" получаем содержимое ответа сервера.
foreach ($ch as $key=>$value) {
    $headers3[$key] = curl_multi_getcontent($ch[$key]);
    //echo "\r\n" . $headers2[$key] . "\r\n";
    curl_multi_remove_handle($mh, $ch[$key]);
}

// Сбрасываем все установленные опции.
foreach ($ch as $key=>$value) {
    curl_reset($ch[$key]);
}

// GET - запрос на выход:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key] . '?_task=logout&_token=' . $tokens[$key]);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, true);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, true);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, true);
    curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    
    //$t1_GET_out    = $tokens[$key];
    //$patch_GET_out = $url . '?_task=mail&token=' . $tokens[$key];
    curl_multi_add_handle($mh, $ch[$key]);
}

// Выполняем запросы curl:
// Переменная "$running" показывает число работающих процессов.
// Переменная "$status" показывает отсутствие ошибок. Инициализируем переменные.
$status = $running= NULL;

// Запускаем множественный обработчик:
// curl_mult_exec запишет в переменную "$running" количество еще не завершившихся процессов.
// Пока они есть - продолжаем выполнять запросы.
do {
    $status = curl_multi_exec($mh, $running);
    if ($running) {
        curl_multi_select($mh);
    }
} while ($running && $status == CURLM_OK);

// В цикле перебираем элементы массива "$ch" получаем содержимое ответа сервера.
foreach ($ch as $key=>$value) {
    $headers4[$key] = curl_multi_getcontent($ch[$key]);
    //echo "\r\n" . $headers2[$key] . "\r\n";
    curl_multi_remove_handle($mh, $ch[$key]);
}

// Сбрасываем все установленные опции.
foreach ($ch as $key=>$value) {
    curl_reset($ch[$key]);
}

/**
* curl_multi_close — Закрывает набор cURL-дескрипторов.
* curl_multi_close(CurlMultiHandle $multi_handle):void
* @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
*/
curl_multi_close($mh);


?>