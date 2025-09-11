<?php
// Логин и пароль для  доступа на почтовый аккаунт.
$user = 'ocik@niiemp.local';
$pass = 'ocik1905niiemp';
//$user = 'l51@niiemp.local';
//$pass = 'l51v6249niiemp';

// Массив содержит WEB - адреса хостов которые будем обрабатывать.
$urls = Array(
    'http://cadmail:10002/rc147-1/',
    'http://cadmail:10002/rc147-2/',
    //'https://cadmail/mail/',
    //'http://localhost/rc147_1/',
    //'http://localhost/rc147_2/',
    //'http://localhost/rc147/'
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
    // В массив "$cooki_files" запишем имена куки - файлов.
    $cooki_files[$key] = 'cookies_' . $key . '.txt';
    // Установка URL и других соответствующих параметров:
    // CURLOPT_AUTOREFERER для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.
    curl_setopt($ch[$key], CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch[$key], CURLOPT_POST, TRUE);
    curl_setopt($ch[$key], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $user . '&_pass=' . $pass);
    curl_setopt($ch[$key], CURLOPT_URL, $url . '?_task=login');
    // CURLOPT_FOLLOWLOCATION для следования любому заголовку "Location: ", отправленному сервером в своём ответе.
    // Смотрите также CURLOPT_MAXREDIRS.
    curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, TRUE);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, TRUE);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, TRUE);
    curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    // CURLOPT_RETURNTRANSFER для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер.
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    // CURLOPT_COOKIEJAR	Имя файла, в котором будут сохранены все внутренние cookies текущей передачи после
    //                      закрытия дескриптора, например, после вызова curl_close.
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cooki_files[$key]);
    // CURLOPT_COOKIEFILE	Имя файла, содержащего cookies.
    //                      Данный файл должен быть в формате Netscape или просто заголовками HTTP, записанными
    //                      в файл. Если в качестве имени файла передана пустая строка, то cookies сохраняться
    //                      не будут, но их обработка всё ещё будет включена.
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cooki_files[$key]);
    // CURLOPT_USERAGENT	Содержимое заголовка "User-Agent: ", посылаемого в HTTP-запросе.
    curl_setopt($ch[$key], CURLOPT_USERAGENT, 'curl/7.81.0');
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
        //sleep(5);
        $ready = curl_multi_select($mh, 1000);
        //sleep(5);
        // Проверяем что ответил сервер: код ответа, содержимое страницы (можно использовать в будущем).
        if ($ready > 0) {
        	/**
			* curl_multi_info_read — Возвращает информацию о текущих операциях.
			* 
			* curl_multi_info_read(CurlMultiHandle $multi_handle, int &$queued_messages=null):array|false
			* 
			* Опрашивает набор дескрипторов о наличии сообщений или информации от индивидуальных передач.
			* Сообщения могут включать такую информацию как код ошибки передачи или просто факт завершения передачи.
			* Повторяющиеся вызовы этой функции будут каждый раз возвращать новый результат, пока не будет возвращено
			* false в качестве сигнала окончания сообщений. Целое число, содержащееся в queued_messages, указывает
			* количество оставшихся сообщений после вызова данной функции.
			* Внимание:
			* Данные, на которые указывает возвращаемый ресурс, будут затёрты вызовом curl_multi_remove_handle().
			* @var multi_handle    Мультидескриптор cURL, полученный из curl_multi_init().
			* @var queued_messages Количество оставшихся сообщений в очереди.
			* Возвращаемые значения:
			* В случае успешного выполнения возвращает ассоциативный массив сообщений или false в случае
			* возникновения ошибки.
			*/
            $info = curl_multi_info_read($mh);
            while ($info) {
            	/**
				* curl_getinfo — Возвращает информацию об определённой операции.
				* 
				* curl_getinfo(CurlHandle $handle, ?int $option=null):mixed
				* Возвращает информацию о последней операции.
				* @var handle Дескриптор cURL, полученный из curl_init().
				* @var option Одна из перечисленных констант.
				* Возвращаемые значения:
				* Если параметр option указан, то возвращается его значение.
				* Иначе возвращается ассоциативный массив со следующими элементами (которые соответствуют значениям
				* аргумента option) или false в случае возникновения ошибки: 
				* https://www.php.net/manual/ru/function.curl-getinfo.php
				*/
                $CURL_OPERATIONS_auth = curl_getinfo($info['handle']);
                $CURLINFO_COOKIELIST_auth = curl_getinfo($info['handle'], CURLINFO_COOKIELIST);
                //echo var_dump($CURL_OPERATIONS['request_header']);
                //echo var_dump($CURL_OPERATIONS['url']);
                break;
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
    $headers1_auth[$key] = curl_multi_getcontent($ch[$key]);
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
    preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $headers1_auth[$key], $token);
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

//// Сбрасываем все установленные опции.
//foreach ($ch as $key=>$value) {
//    /**
//    * curl_reset — Сбросить все настройки обработчика сессии libcurl.
//    * Описание:
//    * curl_reset(CurlHandle $handle):void
//    *
//    * Эта функция переинициализирует все настройки заданного обработчика сессии cURL значениями по умолчанию.
//    * Список параметров:
//    * @var handle Дескриптор cURL, полученный из curl_init().
//    * Возвращаемые значения:
//    * Эта функция не возвращает значения после выполнения.
//    */
//    curl_reset($ch[$key]);
//}

#################
// GET - запрос:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
	// CURLOPT_AUTOREFERER для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.
    curl_setopt($ch[$key], CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $url . '?_task=mail&token=' . $tokens[$key]);
    curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, TRUE);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, TRUE);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, TRUE);
    curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    //curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    //curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cooki_files[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cooki_files[$key]);
    // CURLOPT_USERAGENT	Содержимое заголовка "User-Agent: ", посылаемого в HTTP-запросе.
    curl_setopt($ch[$key], CURLOPT_USERAGENT, 'curl/7.81.0');
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
        $ready=curl_multi_select($mh);
        // Проверяем что ответил сервер: код ответа, содержимое страницы (можно использовать в будущем).
        if ($ready > 0) {
        	$info = curl_multi_info_read($mh);
            while ($info) {
                $CURL_OPERATIONS_GET = curl_getinfo($info['handle']);
                $CURLINFO_COOKIELIST_GET = curl_getinfo($info['handle'], CURLINFO_COOKIELIST);
                //echo var_dump($CURL_OPERATIONS['request_header']);
                //echo var_dump($CURL_OPERATIONS['url']);
                break;
            }
        }
    }
} while ($running && $status == CURLM_OK);

// В цикле перебираем элементы массива "$ch" получаем содержимое ответа сервера.
foreach ($ch as $key=>$value) {
    $headers2_GET[$key] = curl_multi_getcontent($ch[$key]);
    curl_multi_remove_handle($mh, $ch[$key]);
}
#################

//// Сбрасываем все установленные опции.
//foreach ($ch as $key=>$value) {
//    curl_reset($ch[$key]);
//}

// POST - запрос:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
	/**
	* explode — Разбивает строку с помощью разделителя.
	* Описание:
	* explode(string $separator, string $string, int $limit=PHP_INT_MAX):array
	* 
	* Возвращает массив строк, полученных разбиением строки string с использованием separator в качестве разделителя.
	* Список параметров:
	* @var separator Разделитель.
	* @var string    Входная строка.
	* @var limit     Если аргумент limit является положительным, возвращаемый массив будет содержать максимум limit
	*                элементов, при этом последний элемент будет содержать остаток строки string.
	* Если параметр limit отрицателен, то будут возвращены все компоненты, кроме последних -limit.
	* Если limit равен нулю, то он расценивается как 1.
	*/
	// Разабьём строку на массив а потом подставим в заголовок то что нужно от URL-адреса.
	$host=explode('/', $url);
	 
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
        //'Host: '. $_SERVER['HTTP_HOST'],
        'Host: ' . $host['2'],
        //'Host: cadmail:10002',
        //'Origin: '. $_SERVER['HTTP_HOST'],
        'Origin: '. $host['0'] . '//' . $host['2'],
        //'Origin: http://cadmail:10002',
        'Pragma: no-cache',
        'Referer: ' . $url . '?_task=mail',
        'Sec-Ch-Ua: "Chromium";v="94","Yandex";v="21",";Not A Brand";v="99"',
        'Sec-Ch-Ua-Mobile: ?0',
        'Sec-Ch-Ua-Platform: "Windows"',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: same-origin',
        //'User-Agent: "Mozilla/5.0 (Windows NT 6.1; WOW64)"',
        'User-Agent: "curl/7.81.0"',
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
    
    // Отправляем POST - запрос с указанием команды.
    // Установка URL и других соответствующих параметров.
    curl_setopt($ch[$key], CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch[$key], CURLOPT_POST, TRUE);
    //curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cooki_files[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cooki_files[$key]);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, TRUE);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, TRUE);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, TRUE);
    curl_setopt($ch[$key], CURLOPT_HTTPHEADER, $post_headers);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');
    curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch[$key], CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
    //curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов
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
    $headers3_POST[$key] = curl_multi_getcontent($ch[$key]);
    curl_multi_remove_handle($mh, $ch[$key]);
}

//// Сбрасываем все установленные опции.
//foreach ($ch as $key=>$value) {
//    curl_reset($ch[$key]);
//}

// GET - запрос на выход:
// В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
foreach ($urls as $key=>$url) {
	// CURLOPT_AUTOREFERER для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.
    curl_setopt($ch[$key], CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $url . '?_task=logout&_token=' . $tokens[$key]);
    curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch[$key], CURLOPT_VERBOSE, TRUE);
    //curl_setopt($ch[$key], CURLOPT_NOBODY, TRUE);
    curl_setopt($ch[$key], CURLINFO_HEADER_OUT, TRUE);
    curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    //curl_setopt($ch[$key], CURLOPT_REFERER, 'http://localhost/rc147/?_task=mail');
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    //curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cooki_files[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cooki_files[$key]);
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
    $headers4_logout[$key] = curl_multi_getcontent($ch[$key]);
    curl_multi_remove_handle($mh, $ch[$key]);
}

//// Сбрасываем все установленные опции.
//foreach ($ch as $key=>$value) {
//    curl_reset($ch[$key]);
//}

/**
* curl_multi_close — Закрывает набор cURL-дескрипторов.
* curl_multi_close(CurlMultiHandle $multi_handle):void
* @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
*/
curl_multi_close($mh);
?>
