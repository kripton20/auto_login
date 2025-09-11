<?php
class RoundcubeMultiCURL
{
    /**
    * Отладочная информация.
    *
    * Задав TRUE во втором аргументе в конструкторе при создании объекта.
    *
    * @var bool
    */
    public $debugEnabled;

    /**
    * Можно включить запись отладки в лог-файл.
    *
    * Задав TRUE в третьем аргументе в конструкторе при создании объекта.
    *
    * @var bool
    */
    public $writeLogEnabled;

    /**
    * Запись отладочных сообщений в стёк.
    *
    * Чтобы вывести в браузер, вызываем функцию dumpDebugStack().
    *
    * @var array
    */
    public $debugStack;

    /**
    * Набор дескрипторов cURL.
    *
    * @var string
    * @return resourceID
    */
    public $multiCurl;

    /**
    * Массив содержит WEB-адреса хостов которые будем обрабатывать.
    * @param undefined $debugEnabled
    * @param undefined $writeLogEnabled
    *
    * @return
    */
    public $urls;

    /**
    * Логин.
    *
    * @param string $user
    */
    public $user;

    /**
    * Пароль.
    *
    * @param string $password
    */
    public $password;

    /**
    * Создаём новую сессию: для каждого url.
    *
    * @param array $curls
    */
    public $curls;

    /**
    * Получаем ответ от сервера.
    *
    * @param array $content_auth
    */
    //public $content_auth;

    /**
    * Получаем данные по авторизации отправляемые серверу.
    *
    * @param array $content_auth_info
    */
    //public $content_auth_info;

    /**
    * Получаем контент POST-запроса.
    *
    * @param array $content_post
    */
    //public $content_post;

    /**
    * Получаем данные POST-запроса отправляемые серверу.
    *
    * @param array $content_post_info
    */
    //public $content_post_info;

    /**
    * Получаем контент данные GET-запроса на выход получаемые от сервера.
    *
    * @param array $content_h
    */
    public $content_h;

    /**
    * Получаем контент данные GET-запроса на выход отправляемые серверу.
    *
    * @param array $content_get_aut_info
    */
    public $curl_info;

    /**
    * Получаем куки с сервера.
    *
    * @param array $cookies
    */
    public $cookies;

    /**
    * // Запишем в массив "$tokens" полученные токены.
    *
    * @param array $tokens
    */
    public $tokens;

    /**
    * Создаём новый класс RoundcubeMultiCURL.
    */
    public function __construct($urls, $user, $password, $debugEnabled = FALSE, $writeLogEnabled = FALSE)
    {
        // Массив содержит WEB - адреса хостов которые будем обрабатывать.
        $this->urls = $urls;
        // Логин.
        $this->user = $user;
        // Пароль.
        $this->password = $password;
        // Создаём новую сессию: для каждого url.
        $this->curls = array();
        // Получаем данные авторизации получаемые от сервера.
        //$this->content_auth = array();
        // Получаем данные по авторизации отправляемые серверу.
        //$this->content_auth_info = array();
        // Получаем контент POST - запроса.
        //$this->content_post = array();
        // Получаем данные POST - запроса отправляемые серверу.
        //$this->content_post_info = array();
        // Получаем контент данные GET - запроса на выход получаемые от сервера.
        $this->content_h = array();
        // Получаем контент данные GET - запроса на выход отправляемые серверу.
        $this->curl_info = array();
        // Получаем куки с сервера
        $this->cookies = array();
        // Запишем в массив "$tokens" полученные токены.
        $this->tokens = array();
        /**
        * curl_multi_init — Создаёт набор cURL-дескрипторов.
        * curl_multi_init():CurlMultiHandle
        * Позволяет асинхронную обработку множества cURL-дескрипторов.
        * У этой функции нет параметров.
        * Возвращает набор cURL-дескрипторов в случае успешного выполнения или false в случае возникновения ошибки.
        */
        // Создаём набор дескрипторов cURL.
        $this->multiCurl = curl_multi_init();
        // Инициализируем переменные класса:
        // Создаём массив для записи отладочных сообщений в стёк.
        $this->debugStack = array();
        // Вывод отладочной информации в браузер.
        $this->debugEnabled = $debugEnabled;
        // Запись отладочной информации в  в лог - файл.
        $this->writeLogEnabled = $writeLogEnabled;
    }

    // Выполняем авторизацию и установку параметров cURL.
    public function curl_multi_set_auth()
    {
        // В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
        foreach ($this->urls as $key=>$url) {
            // Создаём новую сессию: для каждого url создаем отдельный curl - механизм для отправки запроса.
            $this->curls[$url] = curl_init();
            // Установка URL и других соответствующих параметров:
            // CURLOPT_AUTOREFERER для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:.
            curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
            // CURLOPT_POST    для использования обычного HTTP POST. Данный метод POST использует обычный application / x - www - form - urlencoded, обычно используемый в HTML - формах.
            curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
            // CURLOPT_POSTFIELDS    Все данные, передаваемые в HTTP POST - запросе.
            // Этот параметр может быть передан как в качестве url - закодированной строки, наподобие 'para1 = val1 & para2 = val2&...', так и в виде массива,
            // ключами которого будут имена полей, а значениями - их содержимое. Если value является массивом, заголовок Content - Type будет установлен в значение
            // multipart / form - data. Файлы можно отправлять с использованием CURLFile или CURLStringFile, в этом случае value должен быть массивом.
            curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $this->user . '&_pass=' . $this->password);
            // CURLOPT_URL    Загружаемый URL. Данный параметр может быть также установлен при инициализации сеанса с помощью curl_init().
            curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=login');
            // CURLOPT_VERBOSE    Для вывода дополнительной информации. Записывает вывод в поток STDERR, или файл, указанный параметром CURLOPT_STDERR.
            curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
            // CURLINFO_HEADER_OUT    true для отслеживания строки запроса дескриптора.
            curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
            // CURLOPT_HEADER    true для включения заголовков в вывод.
            curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
            // CURLOPT_RETURNTRANSFER для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер.
            curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
            // CURLOPT_USERAGENT    Содержимое заголовка "User - Agent: ", посылаемого в HTTP - запросе.
            curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
            // curl_multi_add_handle — Добавляет обычный cURL - дескриптор к набору cURL - дескрипторов:
            // Добавляем текущий механизм к числу работающих параллельно.
            curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
        }
    }

    // POST - запрос на выполнение команды WEB - серверу.
    public function curl_multi_set_rm_post()
    {
        // В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
        foreach ($this->urls as $key=>$url) {
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
            // Разабьём строку на массив а потом подставим в заголовок то что нужно от URL - адреса.
            $host         = explode('/', $url);

            // Создаём заголовок для запроса "POST" с заданными параметрами:
            // Переменной "$post_headers" присвоим заголовки POST - запроса.
            $post_headers = array
            (
                // Принимаемые типы данных.
                'Accept: text/html',
                'Accept-Language: ru-RU, ru; q=0.8, en-US; q=0.5, en; q=0.3',
                // Заголовок Accept - Encoding HTTP запроса указывает кодировку контента, которую может понять клиент.
                'Accept-Encoding: *',
                'Accept-Charset: utf-8, windows-1251; q=0.7, *; q=0.7',
                'Cache-Control: no-cache, must-revalidate',
                // Тип передаваемых данных (URL - кодированные данные).
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
                'Host: ' . $host['2'],
                'Origin: '. $host['0'] . '//' . $host['2'],
                'Pragma: no-cache',
                'Referer: ' . $url . '?_task=mail',
                'Sec-Ch-Ua: "Chromium"; v="94", "Yandex"; v="21", "; Not A Brand"; v="99"',
                'Sec-Ch-Ua-Mobile: ?0',
                'Sec-Ch-Ua-Platform: "Windows"',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-origin',
                'User-Agent: "curl/7.81.0"',
                // Отключим браузерное кэширование.
                'Expires: Sat, 01 Jan 2000 00:00:00 GMT',
                'Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT',
                'Cache-Control: post-check=0, pre-check=0',
                'Cache-Control: max-age=0',
                'Upgrade-Insecure-Requests: 1',
                'X-Requested-With: XMLHttpRequest',
                'X-Roundcube-Request: ' . $this->tokens[$url],
                'X-Compress: null',
            );

            // Отправляем POST - запрос с указанием команды:
            // Установка URL и других соответствующих параметров.
            curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
            // CURLOPT_NOBODY    Для исключения тела ответа из вывода.
            // Метод запроса устанавливается в HEAD. Смена этого параметра в false не меняет его обратно в GET.
            curl_setopt($this->curls[$url], CURLOPT_NOBODY, TRUE);
            curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
            // CURLOPT_HTTPHEADER    Массив устанавливаемых HTTP - заголовков,
            // в формате array('Content - type: text / plain', 'Content - length: 100')
            curl_setopt($this->curls[$url], CURLOPT_HTTPHEADER, $post_headers);
            curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=mail&_action=plugin.msg_request');
            curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
            // CURLOPT_COOKIE    Содержимое заголовка "Cookie: ", используемого в HTTP - запросе.
            // Обратите внимание, что несколько cookies разделяются точкой с запятой с последующим пробелом (например, "fruit = apple; colour = red")
            curl_setopt($this->curls[$url], CURLOPT_COOKIE, $this->cookies[$url]);
            curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
            curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
        }
    }

    // GET - запрос на выход:
    public function curl_multi_set_get_aut($del_urls)
    {
        // Делаем перебор массива и если $del_url совпадает с $url выполняем присваивание.
        foreach ($del_urls as $url) {
            curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_HTTPGET, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=logout&_token=' . $this->tokens[$url]);
            curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_NOBODY, TRUE);
            curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($this->curls[$url], CURLOPT_COOKIE, $this->cookies[$url]);
            curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
            curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
        }
        // GET - запрос на выход:
        // В цикле перебираем элементы массива "$urls" и присвоим параметры сесии cURL.
        //        foreach ($this->urls as $key=>$url) {
        //            curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_HTTPGET, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task = logout & _token = ' . $this->tokens[$url]);
        //            curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_NOBODY, TRUE);
        //            curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
        //            curl_setopt($this->curls[$url], CURLOPT_COOKIE, $this->cookies[$url]);
        //            curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl / 7.81.0');
        //            curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
        //        }

    }

    // Получаем контент от WEB - сервера.
    public function curl_multi_getcontent($getcontent)
    {
        // В цикле перебираем элементы массива "$this->curls" получаем содержимое ответа сервера.
        foreach ($this->curls as $key=>$value) {
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
            // Получаем контент от сервера по нашему запросу.
            $this->content_h[$getcontent][$key] = curl_multi_getcontent($this->curls[$key]);

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
            // Получаем данные отправляемые серверу.
            $this->curl_info[$getcontent][$key] = curl_getinfo($value);

            // Следующий блок работает если переменная "$getcontent" равно "auth".
            if ($getcontent == 'auth') {
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
                //preg_match('/^Location:\s\.\ / \?_task = mail & _token = ([A - Za - z0 - 9] + )[ ^ \\n] / im', $this->content_h[$key], $token);
                preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $this->content_h[$getcontent][$key], $token);

                // Запишем в массив "$tokens" полученные токены.
                $this->tokens[$key] = $token['1'];

                // Настройки нашего сервера не позволяют использовать CURLOPT_COOKIEJAR и CURLOPT_COOKIEFILE.
                // Тогда возмём данные Cookie из заголовка ответа сервера используя регулярное выражение "preg_match_all" и функцию "implode":
                // preg_match_all(' / Set - Cookie: (.*); / U', $content, $results);
                // $cookies = implode(';', $results[1]);
                // и установим Cookie с помощью curl_setopt($this->curls, CURLOPT_COOKIE, $cookies);
                /**
                * preg_match_all — Выполняет глобальный поиск шаблона в строке.
                * Описание:
                * preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int $offset=0):int|false|null
                *
                * Ищет в строке subject все совпадения с шаблоном pattern и помещает результат в массив matches в порядке, определяемом комбинацией флагов flags.
                * После нахождения первого соответствия последующие поиски будут осуществляться не с начала строки, а от конца последнего найденного вхождения.
                * Список параметров:
                * @var pattern Искомый шаблон в виде строки.
                * @var subject Входная строка.
                * @var matches Массив совпавших значений, отсортированный в соответствии с параметром flags.
                * @var flags   Может быть комбинацией флагов.
                */
                preg_match_all('/Set-Cookie: (.*);/U', $this->content_h[$getcontent][$key], $results);

                /**
                * implode — Объединяет элементы массива в строку.
                * Описание:
                * implode(string $glue, array $pieces):string
                * implode(array $pieces):string
                *
                * Объединяет элементы массива с помощью строки glue.
                * Замечание:
                * По историческим причинам функции implode() можно передавать аргументы в любом порядке, однако для согласованности с функцией explode()
                * не рекомендуется использовать недокументированный порядок аргументов.
                * Список параметров:
                * @var glue По умолчанию равен пустой строке.
                * @var pieces Массив объединяемых строк.
                * Возвращаемые значения:
                * Возвращает строку, содержащую строковое представление всех элементов массива в указанном порядке, со строкой glue между каждым элементом.
                */
                // Получаем куки с сервера
                $this->cookies[$key] = implode(';', $results[1]);
            }

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
            curl_multi_remove_handle($this->multiCurl, $this->curls[$key]);
        }
    }

    // Выполнение запросов cURL.
    public function curl_multi_exec()
    {
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
            // Выполняем запросы cURL.
            $status = curl_multi_exec($this->multiCurl, $running);
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
            // Ждём окончания активности на любом curl - соединении.
            if (curl_multi_select($this->multiCurl) == - 1) {
                usleep(5);
            }
        } while ($running && $status == CURLM_OK);
    }

    // Сбрасываем все установленные опции.
    public function curl_reset($curl_reset)
    {
        // Сбрасываем все установленные опции.
        foreach ($curl_reset as $value) {
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
            curl_reset($this->curls[$value]);
        }
    }

    // Закрываем набор cURL - дескрипторов.
    public function curl_multi_close()
    {
        /**
        * curl_multi_close — Закрывает набор cURL-дескрипторов.
        * curl_multi_close(CurlMultiHandle $multi_handle):void
        * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
        */
        curl_multi_close($this->multiCurl);
    }

    /**
    * Распечатайте отладочное сообщение, если отладка включена.
    *
    * @param string Короткое сообщение о действии.
    * @param string Выходные данные.
    */
    private function addDebug($action, $data)
    {
        // Если значение свойства "debugEnabled" отсутствует: вернём "FALSE".
        if (!$this->debugEnabled) return FALSE;
        // В массив "debugStack[]" печатаем отладачное сообщение.
        $this->debugStack[] = sprintf(
            "<b>%s:</b><br /><pre>%s</pre>",
            /**
            * htmlspecialchars — Преобразует специальные символы в HTML-сущности.
            *
            * Описание:
            * htmlspecialchars(string $string, int $flags = ENT_COMPAT, string|null $encoding = null, bool $double_encode = true):string
            *
            * В HTML некоторые символы имеют особый смысл и должны быть представлены в виде HTML-сущностей, чтобы сохранить их значение.
            * Эта функция возвращает строку, над которой проведены эти преобразования.
            */
            // Короткое сообщение о действии и выходные данные. Преобразуем специальные символы в HTML - сущности для вывода в браузер.
            $action, htmlspecialchars($data)
        );
    }

    /**
    * Дамп стека отладки.
    */
    public function dumpDebugStack()
    {
        print "<p>".join("\n", $this->debugStack)."</p>";
    }

    /**
    * Функция записи лог-файла в папку скрипта на жёсткий диск.
    */
    static function write_log_file($args)
    {
        // Пишем содержимое (строку) в файл,
        // используя флаг FILE_APPEND flag для дописывания содержимого в конец файла и флаг LOCK_EX
        // для предотвращения записи данного файла кем - нибудь другим в данное время.
        /**
        * Функция записи отладочной информации в log-файл.
        * file_put_contents — Пишет данные в файл
        * file_put_contents(string $filename , mixed $data , int $flags = 0 , resource $context = ?):int
        * Функция идентична последовательным успешным вызовам функций fopen(), fwrite() и fclose().
        * Если filename не существует, файл будет создан. Иначе, существующий файл будет
        * перезаписан, за исключением случая, если указан флаг FILE_APPEND.
        * @param filename   Путь к записываемому файлу.
        * @param data       Записываемые данные. Может быть типа string, array или ресурсом потока.
        *                   Если data является потоковым ресурсом (stream), оставшийся буфер этого потока
        *                   будет скопирован в указанный файл.
        *                   Это похоже на использование функции stream_copy_to_stream().
        *                   Также вы можете передать одномерный массив в качестве параметра data.
        *                   Это будет эквивалентно вызову file_put_contents($filename, implode('', $array)).
        * @param flags      Значением параметра flags может быть любая комбинация следующих флагов,
        *                   соединённых бинарным оператором ИЛИ (|).
        * Доступные флаги:  FILE_USE_INCLUDE_PATH - Ищет filename в подключаемых директориях. Подробнее смотрите
        * директиву include_path; FILE_APPEND - Если файл filename уже существует, данные будут дописаны в конец
        * файла вместо того, чтобы его перезаписать; LOCK_EX - Получить эксклюзивную блокировку на файл на время
        * записи. Другими словами, между вызовами fopen() и fwrite() произойдёт вызов функции flock().
        * Это не одно и то же, что вызов fopen() с флагом "x".
        */
        // Определим путь хранения лог - файла.
        $path = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME);
        file_put_contents(
            $path . '/logs/rc_auto_login.log',
            /**
            * print_r — Выводит удобочитаемую информацию о переменной.
            * Если вы хотите перехватить вывод print_r(), используйте параметр return. Если его значение равно true,
            * то print_r() вернёт информацию вместо вывода в браузер.
            */
            print_r($args, true),
            FILE_APPEND | LOCK_EX
        );
    }
}

/**
* Это исключение входа в систему Roundcube будет сгенерировано, если две попытки входа не удастся.
*/
class RoundcubeLoginException extends Exception
{
}
// Конец класса RoundcubeMultiCURL.

//    /**
// * Относительный путь к базовому каталогу Roundcube на сервере.
// *
// * Можно установить через первый аргумент в конструкторе.
// * Если URL - адрес www.example.com / roundcube / , установите его как « / roundcube / ».
// *
// * @var string
//    */
//    public $rcPath;
//
//    /**
// * Идентификатор сеанса Roundcube.
// *
// * RC отправляет в ответ свой идентификатор сеанса. Если первая попытка не сработает,
// * функция входа в систему повторяет попытку с идентификатором сеанса. Это срабатывает в большинстве случаев.
// *
// * @var string
//    */
//    public $rcSessionID;
//
//    /**
// * Аутентификация текущей сессии Roundcube.
// *
// * RC отправляет в ответ аутентификацию текущей сессии.
//    */
//    private $rcSessionAuth;
//
//    /**
// * Текущий статус сеанса Roundcube.
// * 0 = неизвестно, 1 = вход в систему выполнен, - 1 = вход в систему не выполнен.
// *
// * @var int
//    */
//    public $rcLoginStatus;
//
//    /**
// * Roundcube 0.5.1 добавляет токен запроса для «безопасности». Эта переменная
// * сохраняет последний токен и отправляет его с запросами входа и выхода.
// *
// * @var string
//    */
//    public $lastToken;
//
//    /**
// * Имя хоста где распологается Roundcube.
// * По умолчанию автоматически используется значение $_SERVER['HTTP_HOST'].
// *
// * @var string
//    */
//    private $hostname;
//
//    /**
// * Порт для подключения к серверу где распологается Roundcube.
// * По умолчанию автоматически устанавливается 80 / HTTP или 443 / HTTPS.
// *
// * @var int
//    */
//    private $port;
//
//    /**
// * Свойство которое определяет вид соединения (защищённое или нет) по протоколу SSL / TLS.
// * По умолчанию содержится в переменной $_SERVER['HTTPS'].
// *
// * @var boolean | null
//    */
//    private $ssl;
//
//        /**
// * Можно включить перенаправление в Roundcube для браузера.
// *
// * Задав TRUE в четвёртом аргументе в конструкторе при создании объекта.
// *
// * @var bool
//    */
//    public $sentRedirectEnabled;

//
//    /**
// * Определяем статус входа: проверяем есть - ли активный сеанс Roundcube.
// *
// * @return bool Возвращает TRUE, если пользователь вошел в систему, иначе FALSE.
// * @throws      RoundcubeLoginException
//    */
//    public function isLoggedIn()
//    {
//        // Вызываем функцию "updateLoginStatus()" для определения текущего статуса сеанса.
//        $this->updateLoginStatus();
//        // В условии проверки зачение свойства "rcLoginStatus":
//        if (!$this->rcLoginStatus) {
//            // Неизвестно, ни неудач, ни успехов.
//            // Это может быть так, если идентификатор сеанса не был отправлен.
//            // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//            $this->addDebug("UNKNOWN LOGIN STATUS", "Невозможно определить статус входа: RC не отправил идентификатор сеанса." . "\r\n");
//            // Если значение не получено - генерируем отладочное сообщение.
//            throw new RoundcubeLoginException("Невозможно определить статус входа: RC не отправил идентификатор сеанса." . "\r\n");
//        }
//        // Иначе если не установлено свойство "rcSessionID" - невозможно определить статус входа.
//        elseif (!$this->rcSessionID) {
//            // Если нет доступного идентификатора сеанса, генерируем исключение.
//            $this->addDebug("NO SESSION ID", "Идентификатор сеанса не получен. Версия RC изменена?" . "\r\n");
//            // Генерируем отладочное сообщение.
//            throw new RoundcubeLoginException("Невозможно определить статус входа в систему: идентификатор сеанса не получен. Невозможно продолжить из - за технических проблем." . "\r\n");
//        }
//        // Если свойство"rcLoginStatus" больше 0 (TRUE) - значит вошли в систему,
//        // если меньше 0 (FALSE) - значит не вошли в систему.
//        return ($this->rcLoginStatus > 0) ? TRUE : FALSE;
//    }
//
//    /**
// * Получаем текущий статус входа и файл cookie сеанса.
// * Обновляем переменные rcSessionID и rcLoginStatus на ответ полученный от сервера
// * на отправленный запрос на получение главной страницы формы входа.
//    */
//    private function updateLoginStatus()
//    {
//        // Проверяем если свойства "rcSessionID" и "rcLoginStatus" объекта "rc" существуют:
//        if ($this->rcSessionID && $this->rcLoginStatus) {
//            // то - просто вернёмся в вызывающую функцию.
//            return;
//        }
//        // В условии проверяем: существует - ли глобальный массив "$_COOKIE":
//        if (isset($_COOKIE)) {
//            // В условии проверяем если в глобальном массиве $_COOKIE есть ID сессии:
//            if (isset($_COOKIE['roundcube_sessid'])) {
//                // Присвоим свойству "rcSessionID" текущего объекта значение "roundcube_sessid"
//                // - идентификатор текущей сессии из глобального массива $_COOKIE[''].
//                $this->rcSessionID = $_COOKIE['roundcube_sessid'];
//            }
//            // В условии проверяем если в глобальном массиве $_COOKIE есть аутентификация сессии:
//            if (isset($_COOKIE['roundcube_sessauth'])) {
//                // Присвоим свойству "rcSessionAuth" текущего объекта значение "roundcube_sessauth"
//                // - аутентификацию текущей сессии из глобального массива $_COOKIE.
//                $this->rcSessionAuth = $_COOKIE['roundcube_sessauth'];
//            }
//        }
//        // Отправляем запрос на получение нового идентификатора сеанса и токена.
//        $fp = $this->sendRequest($this->rcPath);
//        // Инициализируем переменную "response" (отклик).
//        $response = "";
//        // Функция feof — проверяет, достигнут ли конец файла (выполняется долго).
//        // Читаем ответ от сервера - присланная страница ответа в браузер.
//        // Читаем содержимое переменной "fp" и формируем страницу ответа от WEB - сервера (страница входа).
//        // Прочитаем ответ от сервера и установим полученные куки.
//        while (!feof($fp)) {
//            /**
// * Функция fgets — читает строку из файла.
// *
// * fgets(resource $handle, int $length = ?):string
// *
// * Читает строку из файлового указателя.
// * Список параметров:
// * @var  handle Указатель на файл должен быть корректным и указывать на файл,
// * успешно открытый функциями fopen() или fsockopen() (и всё ещё не закрытый функцией fclose()).
// * @var length  Чтение заканчивается при достижении length - 1 байт, (это длина считываемой строки в байтах)
// * либо если встретилась новая строка (которая включается в возвращаемый результат)
// * или конец файла (в зависимости от того, что наступит раньше). Если длина не указана,
// * чтение из потока будет продолжаться до тех пор, пока не достигнет конца строки.
// * Возвращаемые значения:
// * Возвращает строку размером в length - 1 байт, прочитанную из дескриптора файла,
// * на который указывает параметр handle. Если данных для чтения больше нет, то возвращает FALSE.
// * В случае возникновения ошибки возвращает FALSE.
//            */
//            // Переменной "line" присвоим значение функции "fgets()":
//            // Прочитаем очередную строку длиной 700 символов из файла (переменная "fp").
//            $line = fgets($fp, 700);
//            /**
// * preg_match — выполняет проверку на соответствие регулярному выражению.
// *
// * preg_match(string $pattern, string $subject, array & $matches = null, int $flags = 0, int $offset = 0):int | FALSE
// *
// * Ищет в заданном тексте subject совпадения с шаблоном pattern.
// *
// * Список параметров:
// * @var pattern Искомый шаблон в виде строки.
// * @var subject Входная строка.
// * @var matches В случае, если указан дополнительный параметр matches, он будет заполнен результатами поиска.
// * Элемент $matches[0] будет содержать часть строки, соответствующую вхождению всего шаблона,
// * $matches[1] - часть строки, соответствующую первой подмаске и так далее.
// * @var flags   flags может быть комбинацией следующих флагов:
// * PREG_OFFSET_CAPTURE - В случае, если этот флаг указан, для каждой найденной подстроки
// * будет указана её позиция (в байтах) в исходной строке. Необходимо помнить, что этот флаг меняет
// * формат возвращаемого массива matches в массив, каждый элемент которого содержит массив,
// * содержащий в индексе с номером 0 найденную подстроку, а смещение этой подстроки в параметре subject - в индексе 1.
// * PREG_UNMATCHED_AS_NULL - Если этот флаг передан, несовпадающие подмаски будут представлены значениями null;
// * в противном случае они отображаются в виде пустых строк (string).
// * @var offset  Обычно поиск осуществляется слева направо, с начала строки. Можно использовать дополнительный параметр
// * offset для указания альтернативной начальной позиции для поиска (в байтах).
// * @return preg_match() возвращает 1, если параметр pattern соответствует переданному параметру subject,
// * 0 если нет, или FALSE в случае ошибки.
// *
// * Замечание:
// * Использование параметра offset не эквивалентно замене сопоставляемой строки выражением substr($subject, $offset)
// * при вызове функции preg_match(), поскольку шаблон pattern может содержать такие условия как ^ , $ или (? <= x).
// * Сравните:
// * В качестве альтернативы substr(), используйте утверждение \G вместо якоря ^ или модификатор A. Оба они работают с параметром offset.
//            */
//            // Далее в условиях разбираем ответ от сервера: проверяем полученные строки и с помощью регулярных выражений
//            // получаем необходимые данные (парсим страницу с ответом). Получаем заголовки HTTP:
//            // Получаем идентификатор текущего сеанса.
//            if (preg_match('/^Set - Cookie:\s * (.+roundcube_sessid = ([ ^ ;] + );.+)$ / i', $line, $match)) {
//                // Отправим в браузер HTTP - заголовок Set - Cookie: roundcube_sessid=.
//                // Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок.
//                // По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков.
//                header($line, FALSE);
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("GET SESSION ID", "Новая сессия ID: '$match[2]'." . "\r\n");
//                // Присвоим ID новой сессии согласно имеющимися куками.
//                $this->rcSessionID = $match[2];
//            }
//            // Получаем аутентификацию текущей сессии.
//            if (preg_match('/^Set - Cookie:.+roundcube_sessauth = ([ ^ ;] + ); / i', $line, $match)) {
//                // Отправим в браузер HTTP - заголовок Set - Cookie: roundcube_sessauth=.
//                // Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок.
//                // По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков.
//                header($line, FALSE);
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("GET SESSION AUTH", "Авторизация нового сеанса: '$match[1]'." . "\r\n");
//                // Присвоим полученную от сервера "rcSessionAuth" - аутентификация текущей сессии.
//                $this->rcSessionAuth = $match[1];
//            }
//            // Получаем токен запроса (начиная с Roundcube 0.5.1).
//            // Переопределим предыдущий токен (если он существует!).
//            // Получаем токен из заголовка ответа сервера (начиная с Roundcube 0.5.1).
//            // http://website - lab.ru / article / regexp / shpargalka_po_regulyarnyim_vyirajeniyam /
//            if ((preg_match(' / "request_token":"([ ^ "] + )", / mi', $response, $m)) ||
//                (preg_match('/<input.+name = "_token".+value = "([ ^ "] + )" > ( < div>|\n | \s) / i', $line, $m))) {
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("GET SESSION TOKEN", "Токен: '$m[1]'." . "\r\n");
//                // Получаем токен из формы ввода логина и пароля на странице ответа от сервера.
//                // Присвоим свойству "lastToken" полученный от сервера токен,
//                // и запишем значение из массива "m[1]" в свойство "lastToken".
//                $this->lastToken = $m[1];
//            }
//            // Если сервер прислал страницу со списком писем - значит сеанс активный.
//            if (preg_match('/<input.+name = "_pass" / mi', $line)) {
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("NOT LOGGED IN", "Мы не вошли в систему." . "\r\n");
//                // Присвоим статус - "Мы не вошли в систему".
//                $this->rcLoginStatus =-1;
//                // Добавим очередную строку в переменную "response".
//                $response .= $line;
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей страницу полученную от сервера
//                // в переменной "$response".
//                $this->addDebug("RESPONSE", $response . "\r\n");
//                // Прекратим поиск (для увеличения бастродействия).
//                break;
//            }
//            // Иначе если сервер прислал страницу с формой входа с полем для ввода пароля - значит мы не вошли в систему.
//            elseif (preg_match('/<div.+id = "messagetoolbar" / mi', $line)) {
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("LOGGED IN", "Мы вошли в систему." . "\r\n");
//                // Присвоим статус - "Мы вошли в систему".
//                $this->rcLoginStatus = 1;
//                // Прекратим поиск (для увеличения бастродействия).
//                //break;
//            }
//            // В условии проверяем: если переменная "line" содержит строку с тегом "</html > " - значит страница закончилась:
//            if (preg_match('/<\ / html>/mi', $line)) {
//                // Добавим очередную строку в переменную "response".
//                $response .= $line;
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей страницу
//                // полученную от сервера в переменной "$response".
//                $this->addDebug("RESPONSE", $response . "\r\n");
//                // Прекратим поиск (для увеличения бастродействия).
//                break;
//            }
//            // Иначе если сервер прислал страницу сстраницу с ошибкой 404.
//            elseif (preg_match('/^HTTP\ / 1\.\d\s + 404\s+/', $line)) {
//                // Генерируем отладочное сообщение.
//                throw new RoundcubeLoginException("Установка Roundcube не найдена на '$path'." . "\r\n");
//            }
//            // Добавим очередную строку в переменную "response".
//            $response .= $line;
//        }
//        // Функция fclose — закрывает открытый дескриптор файла.
//        fclose($fp);
//    }
//
//    /**
// * Отправьте запрос POST / GET сценарию входа в Roundcube для имитации входа в систему.
// * Если установлен второй параметр postData, функция будет
// * используйте метод POST, иначе будет отправлено GET.
// * Обеспечивает отправку всех файлов cookie и анализирует все заголовки ответов
// * для нового идентификатора сеанса Roundcube. Если обнаружен новый SID, устанавливается rcSessionId.
// *
// * @param string  Необязательные данные POST в кодированной форме (param1 = value1&...)
// * @return string Возвращает полный ответ на запрос со всеми заголовками.
//    */
//    public function sendRequest($path, $postData = FALSE)
//    {
//        // Определяем формат запроса.
//        $method = (!$postData) ? "GET" : "POST";
//        // Получаем значение SSL.
//        $isSSL = $this->ssl;
//        // В условии проверяем значение переменной "isSSL":
//        if ($isSSL === null) {
//            /**
// * isset — определяет, была ли установлена переменная значением, отличным от null.
// *
// * isset(mixed $var, mixed ...$vars):bool
// *
// * Если переменная была удалена с помощью unset(), то она больше не считается установленной.
// * isset() вернёт false при проверке переменной которая была установлена значением null.
// * Также учтите, что NULL это символ ("\0") не равен константе null в PHP. Если были переданы
// * несколько параметров, то isset() вернёт true только в том случае, если все параметры определены.
// * Проверка происходит слева направо и заканчивается, как только будет встречена неопределённая переменная.
// *
// * @var mixed Проверяемая переменная.
// * @var vars  Следующие переменные.
// *
// * @return TRUE Возвращает true, если var определена и её значение отлично от null, и false в противном случае.
//            */
//            // Если эквивалентно "null" - то присвоим "HTTPS".
//            $isSSL = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'];
//        }
//        // В условии проверяем - если переменная "port" не существует:
//        // значит номер порта отсутствует.
//        if (!$this->port) {
//            // В условии проверяем - если порт есть и имеет числовое значение:
//            if (isset($_SERVER['SERVER_PORT']) && is_numeric($_SERVER['SERVER_PORT'])) {
//                // Присвоим номер порта из глобальной переменной.
//                // Свойству "port" переменной - объекта "rcl" присвоим значение переменной "port".
//                $this->port = $_SERVER['SERVER_PORT'];
//            }
//            // Иначе если установлено значение переменной "$isSSL" - используется протокол SSL:
//            elseif ($isSSL) {
//                // Присвоим номер порта - 443.
//                $this->port = 443;
//            }
//            // Иначе приссвоим порт По - умолчанию - 80.
//            else {
//                $this->port = 80;
//            }
//        }
//        // В условии проверяем - если имя хоста отсутствует - устанавливаем имя хоста.
//        if (!$this->hostname) {
//            // В условии проверяем - если имя хоста содержится
//            // в глобальном массиве "$_SERVER['']" в значении "SSL_TLS_SNI":
//            if ($isSSL && isset($_SERVER['SSL_TLS_SNI']) && $_SERVER['SSL_TLS_SNI']) {
//                // Присвоим это значение переменной "host" из глобального массива "$_SERVER['']".
//                $this->hostname = $_SERVER['SSL_TLS_SNI'];
//            }
//            // Иначе если имя хоста содержится в глобальном массиве "$_SERVER['']" в значении "HTTP_HOST":
//            elseif (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']) {
//                // Свойству "hostname" переменной - объекта "rcl" присвоим значение переменной "host".
//                // Присвоим это значение переменной "host" из глобального массива "$_SERVER['']".
//                $this->hostname = $_SERVER['HTTP_HOST'];
//            }
//            // Иначе присвоим имя хоста "127.0.0.1".
//            else {
//                $this->hostname = "127.0.0.1";
//            }
//        }
//        // Если переменная "isSSL" равно TRUE:
//        if ($isSSL) {
//            // Тогда будем использовать протокол SSL.
//            $this->hostname = "ssl://$this->hostname";
//        }
//        // Инициируем переменную - массив "cookies".
//        $cookies = array();
//        // В цикле перебираем глобальный массив "_COOKIE", получаем имя и значение куков.
//        // Загрузите файлы cookie и сохраните их в массиве ключ / значение.
//        foreach ($_COOKIE as $name=>$value) {
//            $cookies[] = "$name = $value";
//        }
//        /**
// * Поставим символ "@" для подавления вывода сообщений об ошибках.
//        */
//        // В условии проверяем если в глобальном массиве $_COOKIE[''] есть ID сессии
//        // и свойство "rcSessionID" текущего объекта содержит ID сессии :
//        if (@!$_COOKIE['roundcube_sessid'] && $this->rcSessionID) {
//            // Присвоим массиву "$cookies" значение свойства "rcSessionID" текущего объекта.
//            $cookies[] = "roundcube_sessid = {$this->rcSessionID}";
//        }
//        // В условии проверяем если в глобальном массиве $_COOKIE[''] есть аутентификация сессии
//        // и свойство "rcSessionAuth" текущего объекта содержит аутентификацию сессии:
//        if (@!$_COOKIE['roundcube_sessauth'] && $this->rcSessionAuth) {
//            // Присвоим массиву "$cookies" значение свойства "rcSessionAuth" текущего объекта.
//            $cookies[] = "roundcube_sessauth = {$this->rcSessionAuth}";
//        }
//        // Перезапишем переменную "cookies" в формат который можно использовать в запросе
//        // (в первом запросе к серверу отправляем пустые куки).
//        $cookies = ($cookies) ? "Cookie: ".join("; ", $cookies)."\r\n" : "";
//        // Создаём запрос с куками для получения идентификатора сессии.
//        // Описание заголовков запросов запросов находится здесь:
//        // https://developer.mozilla.org / ru / docs / Web / HTTP / Headers
//        // В условии проверяем какой формат запроса использовать: если переменная "$method" == "POST":
//        //        if ($method == "POST") {
//        //            // Создаём запрос POST с заданными данными.
//        //            // Переменной "request" присвоим тело POST - запроса.
//        //            $request =
//        //            "POST ".$path." HTTP / 1.1" . "\r\n" .
//        //            "Host: ".$_SERVER['HTTP_HOST'] . "\r\n" .
//        //            "User - Agent: ".$_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//        //            "Content - Type: application / x - www - form - urlencoded" . "\r\n" .
//        //            "Content - Length: ". strlen($postData) . "\r\n" .
//        //            $cookies .
//        //            "Connection: close" . "\r\n\r\n" .
//        //            $postData;
//        //        }
//        //        // Иначе создаём запрос "GET" с заданными параметрами.
//        //        else {
//        //            // Переменной "request" присвоим тело GET - запроса.
//        //            $request =
//        //            "GET " . $path . " HTTP / 1.1" . "\r\n" .
//        //            "Host: " . $_SERVER['HTTP_HOST'] . "\r\n" .
//        //            "User - Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//        //            $cookies .
//        //            "Connection: close" . "\r\n\r\n";
//        //        }
//        //        if ($method == "POST") {
//        //            // - создаём запрос "POST" с заданными параметрами.
//        //            // Переменной "request" присвоим заголовки POST - запроса.
//        //            $request =
//        //            'POST '. $path.' HTTP / 1.1' . "\r\n" .
//        //            'Host: '. $_SERVER['HTTP_HOST'] . "\r\n" .
//        //            'Content - Length: '. strlen($postData) . "\r\n" .
//        //
//        //            // Отключим браузерное кэширование.
//        //            'Expires: Sat, 01 Jan 2000 00:00:00 GMT' . "\r\n" .
//        //            'Last - Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT' . "\r\n" .
//        //            'Cache - Control: no - cache, must - revalidate' . "\r\n" .
//        //            'Cache - Control: post - check = 0,pre - check = 0' . "\r\n" .
//        //            'Cache - Control: max - age = 0' . "\r\n" .
//        //            'Pragma: no - cache' . "\r\n" .
//        //
//        //            //'Cache - Control: no - cache' . "\r\n" .
//        //            //'Pragma: no - cache' . "\r\n" .
//        //
//        //            'Upgrade - Insecure - Requests: 1' . "\r\n" .
//        //            //'Origin: http://localhost' . "\r\n" .
//        //            'Origin: '. $_SERVER['HTTP_HOST'] . "\r\n" .
//        //            // Тип данных (данные из формы).
//        //            'Content - Type: application / x - www - form - urlencoded' . "\r\n" .
//        //            'User - Agent: '. $_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//        //            // Принимаемые типы данных: text / html,application / xhtml + xml,application / xml.
//        //            'Accept: text / html,application / xhtml + xml,application / xml;q = 0.9,image / avif,image / webp,image / apng,*/*;q = 0.8,application / signed - exchange;v = b3;q = 0.9' . "\r\n" .
//        //            //'accept: text / html,application / xhtml + xml,application / xml;q = 0.9,image / webp,image / apng,*/*;q = 0.8,application / signed - exchange;v = b3' . "\r\n" .
//        //            //'sec - fetch - user: ?1' . "\r\n" .
//        //            //'x - compress: null' . "\r\n" .
//        //            'Sec - Fetch - Site: same - origin' . "\r\n" .
//        //            'Sec - Fetch - Mode: navigate' . "\r\n" .
//        //            'Sec - Fetch - User: ?1' . "\r\n" .
//        //            'Sec - Fetch - Dest: document' . "\r\n" .
//        //            //'sec - fetch - site: none' . "\r\n" .
//        //            //'sec - fetch - mode: navigate' . "\r\n" .
//        //            'Accept - Encoding: gzip, deflate, br' . "\r\n" .
//        //            // И понимаю я только текст и html.
//        //            'Accept - Language: ru,en;q = 0.9' . "\r\n" .
//        //            //'accept - encoding: deflate, br' . "\r\n" .
//        //            //'accept - language: ru - RU,ru;q = 0.9,en - US;q = 0.8,en;q = 0.7' . "\r\n" .
//        //            $cookies .
//        //            'Connection: close' . "\r\n\r\n" .
//        //            $postData;
//        //
//        //        }
//        //        // Иначе создаём запрос "GET" с заданными параметрами.
//        //        else {
//        //            // Переменной "request" присвоим тело GET - запроса.
//        //            $request =
//        //            "GET " . $path . " HTTP / 1.1" . "\r\n" .
//        //            "Host: " . $_SERVER['HTTP_HOST'] . "\r\n" .
//        //            "User - Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//        //            $cookies .
//        //            "Connection: close" . "\r\n\r\n";
//        //        }
//        if ($method == "POST") {
//            //-создаём запрос "POST" с заданными параметрами.
//            // Переменной "request" присвоим заголовки POST - запроса.
//            $request =
//            'POST '. $path . ' HTTP / 1.1' . "\r\n" .
//            // Принимаемые типы данных.
//            'Accept: text / html,application / xhtml + xml,application / xml;q = 0.9,image / avif,image / webp,image / apng,*/*;q = 0.8,application / signed - exchange;v = b3;q = 0.9;application / json,text / javascript,*/*;q = 0.01' . "\r\n" .
//            'Accept - Encoding: gzip,deflate,br' . "\r\n" .
//            'Accept - Language: ru - RU,ru;q = 0.9,en - US;q = 0.8,en;q = 0.7' . "\r\n" .
//            'Accept - Charset: utf - 8,windows - 1251;q = 0.7, * ;q = 0.7' . "\r\n" .
//            'Cache - Control: no - cache,must - revalidate' . "\r\n" .
//            // Тип передаваемых данных (URL - кодированные данные).
//            'Content - Type: application / x - www - form - urlencoded;charset = UTF - 8' . "\r\n" .
//            'Host: '. $_SERVER['HTTP_HOST'] . "\r\n" .
//            'Origin: '. $_SERVER['HTTP_HOST'] . "\r\n" .
//            'Pragma: no - cache' . "\r\n" .
//            //'Referer: http://cadmail:10002 / rc147 - 50 / ?_task = mail' . "\r\n" .
//            'Referer: '. $_SERVER['HTTP_HOST'] . "\r\n" .
//            'Sec - Ch - Ua: "Chromium";v = "94","Yandex";v = "21",";Not A Brand";v = "99"' . "\r\n" .
//            'Sec - Ch - Ua - Mobile: ?0' . "\r\n" .
//            'Sec - Ch - Ua - Platform: "Windows"' . "\r\n" .
//            'Sec - Fetch - Dest: empty' . "\r\n" .
//            //'Sec - Fetch - Dest: document' . "\r\n" .
//            'Sec - Fetch - Mode: cors' . "\r\n" .
//            //'Sec - Fetch - Mode: navigate' . "\r\n" .
//            'Sec - Fetch - Site: same - origin' . "\r\n" .
//            ////'Sec - Fetch - Site: none' . "\r\n" .
//            ////'Sec - Fetch - User: ?1' . "\r\n" .
//            'User - Agent: ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//            // Отключим браузерное кэширование.
//            'Expires: Sat, 01 Jan 2000 00:00:00 GMT' . "\r\n" .
//            'Last - Modified: ' . gmdate("D, dMYH:i:s") . ' GMT' . "\r\n" .
//            'Cache - Control: post - check = 0,pre - check = 0' . "\r\n" .
//            'Cache - Control: max - age = 0' . "\r\n" .
//            'Upgrade - Insecure - Requests: 1' . "\r\n" .
//            'X - Requested - With: XMLHttpRequest' . "\r\n" .
//            //'X - Roundcube - Request: ' . $token[1] . "\r\n" .
//            'X - Roundcube - Request: ' . $this->lastToken . "\r\n" .
//            'X - Compress: null' . "\r\n" .
//            'Content - Length: '. strlen($postData) . "\r\n" .
//            $cookies . "\r\n" .
//            'Connection: close' . "\r\n\r\n" .
//            $postData;
//        }
//        // Иначе создаём запрос "GET" с заданными параметрами.
//        else {
//            // Переменной "request" присвоим тело GET - запроса.
//            $request =
//            "GET " . $path . " HTTP / 1.1" . "\r\n" .
//            "Host: " . $_SERVER['HTTP_HOST'] . "\r\n" .
//            "User - Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n" .
//            $cookies .
//            "Connection: close" . "\r\n\r\n";
//        }
//        /**
// * fsockopen — Открывает соединение с интернет - сокетом или доменным сокетом Unix.
// *
// * fsockopen(string $hostname, int $port=-1, int & $error_code = null, string & $error_message = null, float | null $timeout = null):resource | FALSE
// *
// * Устанавливает соединение с сокетом ресурса hostname.
// * PHP поддерживает целевые ресурсы в интернете и Unix - доменах в том виде, как они описаны в списке поддерживаемых транспортных протоколов.
// * Список поддерживаемых транспортов можно получить с помощью функции stream_get_transports().
// * По умолчанию сокет будет открыт в блокирующем режиме. Переключить его в неблокирующих режим можно функцией stream_set_blocking().
// * stream_socket_client() выполняет аналогичную функцию, но предоставляет более широкий выбор настроек соединения,
// * включающий установку неблокирующего режима и возможность предоставления потокового контекста.
// * @var hostname      Если установлена поддержка OpenSSL, можно использовать SSL - или TLS - протоколы соединений
// * поверх TCP / IP при подключении к удалённому хосту. Для этого перед hostname нужно добавить префикс ssl:// или tls://.
// * @var port          Номер порта. Его можно не указывать, передав - 1 для тех протоколов, которые не используют порты, например unix://.
// * @var error_code    Если этот параметр предоставить, то в случае ошибки системного вызова функции connect() он будет принимать номер этой ошибки.
// * Если значение параметра error_code равно 0, а функция вернула FALSE, значит ошибка произошла до вызова connect().
// * В большинстве случаев это свидетельствует о проблемах при инициализации сокета.
// * @var error_message Сообщение об ошибке в виде строки.
// * @var timeout       Тайм - аут соединения в секундах.
// * Замечание:
// * Если требуется установить тайм - аут чтения / записи данных через сокет, используйте функцию stream_set_timeout(),
// * т.к. параметр timeout функции fsockopen() ограничивает только время процесса установки соединения с сокетом.
// *
// * @return fp         Функция возвращает файловый указатель, который можно использовать с функциями,
// * работающие с файлами (такие как fgets(), fgetss(), fwrite(), fclose() и feof()).
// * Если вызов завершится неудачно, функция вернёт FALSE.
// * Ошибки:
// * Вызывает ошибку уровня E_WARNING, если hostname не является допустимым доменом.
//        */
//        // Оправляем запрос на сервер.
//        $fp = fsockopen($this->hostname, $this->port);
//        // Условие проверки существования переменной "fp", если её нет - значит запрос не отправился.
//        if (!$fp) {
//            // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//            $this->addDebug("UNABLE TO OPEN SOCKET", "Не удалось открыть сокет для $host в порту $port" . "\r\n");
//            // Генерируем отладочное сообщение.
//            throw new RoundcubeLoginException("Не удалось открыть сокет для $host в порту $port." . "\r\n");
//        }
//        // Иначе: Просто запишем отладочное сообщение в массив "debugStack[]":
//        else {
//            // Вызываем функцию "addDebug()" и передаём ей сообщение содержащее наш запрос.
//            $this->addDebug("REQUEST", $request . "\r\n");
//        }
//        // fputs или fwrite — бинарно - безопасная запись в файл.
//        // Записываем ответ от сервера на запрос "$request" - в переменную "$fp".
//        fputs($fp, $request);
//        // Вернём значение переменной "fp" - указатель на файл.
//        return $fp;
//    }
//
//    /**
// * Войдите в Roundcube, используя имя пользователя / пароль IMAP
// *
// * Примечание: если функция обнаруживает, что мы уже вошли в систему, она выполняет повторный вход,
// * то есть комбинацию выхода / входа, чтобы гарантировать, что указанный пользователь вошел в систему.
// *
// * Если вы этого не хотите, используйте функцию isLoggedIn() и перенаправьте RC без вузова login().
// * @param string   имя пользователя IMAP
// * @param string   пароль IMAP (простой текст)
// * @param boolean  Указывает делать выход из системы перед тем как снова логиниться или нет:
// * $logout = TRUE - сделать выход из Roundcube, $logout = FALSE - не делать выход из Roundcube)
// * @return boolean Возвращает TRUE, если вход был успешным, в противном случае возвращает FALSE
// * @throws         RoundcubeLoginException
//    */
//    public function login($username, $password, $logout = TRUE)
//    {
//        /**
// * Следующие две функции: "updateLoginStatus()" и "isLoggedIn()" проверяют статус входа.
// * Если Вы используете свой коннектор для подключения к классу "RoundcubeMultiCURL" -
// * раскомментируйте их - они Вам могут понадобиться.
//        */
//        // Получаем текущий статус входа и файл cookie сеанса.
//        //$this->updateLoginStatus();
//        // Условие проверки статуса входа в систему ().
//        //if ($this->isLoggedIn()) {
//        //    // Условие проверки переменной входа / выхода.
//        //    if ($logout == TRUE) {
//        //        // Если вы уже вошли в систему для выполнения повторного входа нужно выполнить выход из Roundcube.
//        //        $this->logout();
//        //    }
//        //    // Иначе продлеваем сессию.
//        //    else {
//        //        // session_start — стартует новую сессию, либо возобновляет существующую.
//        //        // session_reset — реинициализирует сессию оригинальными значениями https://www.php.net / manual / ru / function.session - reset.php
//        //        session_start();
//        //    }
//        //}
//
//        // Выполняем вход в Roundcube: Формируем данные для POST - запроса.
//        // Сначала нужно отправить _task = login и получить перенаправление, а потом отправить task = mail и получить вход.
//        // Команда передаваемая приложению Roundcube для выполнения:
//        // Действие - "login", задача - "login", временная зона По - умолчанию, url - отсутствует.
//        //" & _task = login & _action = login & _timezone = _default_ & _url = " . //&_timezone = Etc / GMT - 3
//        $data = '_task = login & _action = login & _timezone = Europe / Moscow & _url = ' .
//        // Логин и пароль.
//        ' & _user = ' . urlencode($username) . ' & _pass = ' . urlencode($password) .
//        // В условии проверяем есть - ли токен: если нету - получаем токен:
//        (($this->lastToken) ? ' & _token = ' . $this->lastToken : '');
//        // Переменной "$fp" присвоим указатель на файл из которого будем читать ответ от сервера.
//        $fp = $this->sendRequest($this->rcPath . '?_task = login', $data); // . "?_task = login"
//        // Инициализируем переменную "response" (отклик - ответ от сервера).
//        $response = "";
//        // Функция feof — проверяет, достигнут ли конец файла (выполняется долго).
//        // Читаем ответ от сервера - присланная страница ответа в браузер.
//        // Читаем содержимое переменной "fp" и формируем страницу ответа от WEB - сервера (страница входа).
//        // Прочитаем ответ от сервера и установим полученные куки.
//        while (!feof($fp)) {
//            // Переменной "line" присвоим значение функции "fgets()":
//            // Прочитаем очередную строку длиной 700 символов из файла (переменная "fp").
//            $line = fgets($fp, 700);
//            // Далее в условиях разбираем ответ от сервера: проверяем полученные строки и с помощью регулярных выражений
//            // получаем необходимые данные (парсим страницу с ответом). Получаем заголовки HTTP:
//            // Получаем идентификатор текущего сеанса.
//            if (preg_match('/^Set - Cookie:\s * (.+roundcube_sessid = ([ ^ ;] + );.+)$ / i', $line, $match)) {
//                // Отправим в браузер HTTP - заголовок Set - Cookie: roundcube_sessid=.
//                // Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок.
//                // По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков.
//                header($line, FALSE);
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("GET SESSION ID", "Новая сессия ID: '$match[2]'." . "\r\n");
//                // Присвоим ID новой сессии согласно имеющимися куками.
//                $this->rcSessionID = $match[2];
//            }
//            // Получаем аутентификацию текущей сессии.
//            if (preg_match('/^Set - Cookie:.+roundcube_sessauth = ([ ^ ;] + ); / i', $line, $match)) {
//                // Отправим в браузер HTTP - заголовок Set - Cookie: roundcube_sessauth=.
//                // Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок.
//                // По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков.
//                header($line, FALSE);
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("GET SESSION AUTH", "Авторизация нового сеанса: '$match[1]'." . "\r\n");
//                // Присвоим полученную от сервера "rcSessionAuth" - аутентификация текущей сессии.
//                $this->rcSessionAuth = $match[1];
//            }
//            // В условии проверяем: если от сервера получено перенаправление на задачу ./?_task = ... :
//            // значит авторизация пройдена успешно.
//            if (preg_match('/^Location\:.+_task=/mi', $line)) {
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("LOGIN SUCCESSFUL", "RC отправил перенаправление на ./?_task=..., значит мы авторизовались!" . "\r\n");
//                // Присвоим статус - вошли в систему.
//                $this->rcLoginStatus = 1;
//                // Добавим очередную строку в переменную "response".
//                $response .= $line;
//                // Прекратим поиск (для увеличения бастродействия).
//                break;
//                // Обнаружена ошибка входа: если логин / пароль не верные, RC отправляет cookie "sessionsauth =-del - ".
//            }elseif (preg_match('/^Set - Cookie:.+sessauth=-del - ; / mi', $line)) {
//                // Отправим в браузер HTTP - заголовок с имеющимися куками.
//                // Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок.
//                // По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков.
//                header($line, FALSE);
//                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей сообщение.
//                $this->addDebug("LOGIN FAILED", "RC отправил 'sessauth=-del - '; Комбинация логин / пароль неправильная." . "\r\n");
//                // Присвоим статус - не вошли в систему.
//                $this->rcLoginStatus = - 1;
//                // Добавим очередную строку в переменную "response".
//                //$response .= $line;
//                // Генерируем отладочное сообщение.
//                //throw new RoundcubeLoginException("Ошибка входа в систему из - за неправильной комбинации логин / пароль." . "\r\n");
//            }
//            // Добавим очередную строку в переменную "response".
//            $response .= $line;
//        }
//        // Запишем отладочное сообщение в массив "debugStack[]":
//        // вызываем функцию "addDebug()" и передаём ей страницу полученную от сервера в переменной "$response".
//        $this->addDebug("RESPONSE", $response . "\r\n");
//        // Отправим GET - запрос по адресу полученному в ответе 302 (Location: ./&_token = токен)
//        // Команда передаваемая приложению Roundcube для выполнения:
//        // Задача - "task = mail", и данные - "token = токен".
//        // Переменной "$fp" присвоим указатель на файл из которого будем читать ответ от сервера.
//        $fp = $this->sendRequest($this->rcPath . "?_task = mail" . (($this->lastToken) ? " & _token = " . $this->lastToken : ""));
//        // Инициализируем переменную "response" (отклик - ответ от сервера).
//        //$response1 = "";
////        // Функция feof — проверяет, достигнут ли конец файла (выполняется долго).
////        // Читаем ответ от сервера - присланная страница ответа в браузер.
////        // Читаем содержимое переменной "fp" и формируем страницу ответа от WEB - сервера (страница входа).
////        // Прочитаем ответ от сервера и установим полученные куки.
////        while (!feof($fp)) {
////            // Переменной "line" присвоим значение функции "fgets()":
////            // Прочитаем очередную строку длиной 700 символов из файла (переменная "fp").
////            $line1 = fgets($fp, 700);
////            // Далее в условиях разбираем ответ от сервера: проверяем полученные строки и с помощью регулярных выражений
////            // получаем необходимые данные (парсим страницу с ответом). Получаем заголовки HTTP:
////            // Получаем идентификатор текущего сеанса.
////            if (preg_match('/<\ / html>/mi', $line1)) {
////                // Добавим очередную строку в переменную "response".
////                $response1 .= $line1;
////                // Запишем отладочное сообщение в массив "debugStack[]": вызываем функцию "addDebug()" и передаём ей страницу полученную от сервера
////                // в переменной "$response".
////                $this->addDebug("RESPONSE", $response1 . "\r\n");
////                // Прекратим поиск (для увеличения бастродействия).
////                break;
////            }
////            // Добавим очередную строку в переменную "response".
////            $response1 .= $line1;
////        }
//        // Перенаправление на авторизовунную страницу браузера.
//        $this->redirect();
//        // Вернём значение функции "isLoggedIn()".
//        return $this->isLoggedIn();
//    }
//
//    /**
// * Выход из Roundcube.
// *
// * @return bool Возвращает TRUE, если вход был успешным, в противном случае возвращает FALSE.
//    */
//    public function logout()
//    {
//        // Вызываем функцию "sendRequest()" - отправляем запрос серверу:
//        // Формируем строку для GET - запроса: Команда передаваемая приложению Roundcube для выполнения:
//        // задача - "logout" и токен.
//        $this->sendRequest($this->rcPath . "?_task = logout" . (($this->lastToken) ? " & _token = ".$this->lastToken : ""));
//        // Удалим глобальный массив "$_COOKIE" чтобы при следующем входе из него не считывались данные (unset — удаляет переменную).
//        unset($_COOKIE);
//        // Свойству "rcLoginStatus" объекта "rcl" присвоим - 0.
//        $this->rcLoginStatus = 0;
//        // Свойству "rcSessionID" объекта "rcl" присвоим - FALSE.
//        $this->rcSessionID = FALSE;
//        // Проверяем статус входа: Вызываем функцию "isLoggedIn()" и вернём её значение.
//        return $this->isLoggedIn();
//    }
//
//    /**
// * Перенаправление в приложение Roundcube.
//    */
//    public function redirect($path_folders = NULL)
//    {
//        // Получаем адрес страницы для перенаправления:
//        //   если переменная "$path_folders" равна "NULL" - значит при входе попадаем на главную страницу,
//        //   иначе если переменная "$path_folders" не равна "NULL" - значит при входе попадаем в указанную
//        //   папку и подпапку.
//        $path_folders ? $rcPath = $this->rcPath . $path_folders : $rcPath = $this->rcPath;
//        /**
// * header — отправка HTTP - заголовка в браузер.
// *
// * header(string $header , bool $replace = TRUE , int $response_code = 0 ):void
// *
// * Функция header() используется для отправки HTTP - заголовка в браузер, точнее, для добавления заголовка к документу,
// * пересылаемому браузеру. Она может быть вызвана только до первой команды вывода сценария, если клиенту ещё
// * не передавались данные, конечно, если в PHP не включена буферизация.
// * То есть она должна идти первой в выводе, перед её вызовом не должно быть никаких HTML - тегов, пустых строк и т.п.
// * Довольно часто возникает ошибка, когда при чтении кода файловыми функциями, вроде include или require,
// * в этом коде попадаются пробелы или пустые строки, которые выводятся до вызова header().
// * Те же проблемы могут возникать и при использовании PHP / HTML в одном файле.
// *
// * Список параметров:
// * @var string header  Строка заголовка.
// * Существует два специальных заголовка:
// * Один из них начинается с "HTTP / " (регистр не важен) и используется для отправки кода состояния HTTP. Например,
// * если веб - сервер сконфигурирован таким образом, чтобы запросы к несуществующим файлам обрабатывались средствами PHP
// * (используя директиву ErrorDocument), вы наверняка захотите убедиться, что скрипт генерирует правильный код состояния.
// * Другим специальным видом заголовков является "Location:". В этом случае функция не только отправляет этот заголовок браузеру,
// * но также возвращает ему код состояния REDIRECT (302), если ранее не был установлен код 201 или 3xx.
// * @var string replace Необязательный параметр replace определяет, надо - ли заменять предыдущий аналогичный заголовок или заголовок того же типа.
// * По - умолчанию заголовок будет заменён, но если передать false, можно задать несколько однотипных заголовков. Например:
// * response_code - принудительно задаёт код ответа HTTP. Следует учитывать, что это будет работать, только если строка header
// * не является пустой.
// *
// * Эта функция не возвращает значения после выполнения.
// * http://www.faqs.org / rfcs / rfc2616.html
//        */
//        // Перенаправление на страницу указанную в переменной "rcPath".
//        header("Location: {$rcPath}");
//    }
//
//    /**
// * Задаём имя хоста.
// *
// * Обратите внимание - если имя хоста будет указывать на имя локальной машины.
// * То функция не будет работать для удаленных машин.
// * @param string Имя хоста или FALSE для использования по умолчанию.
//    */
//    public function setHostname($hostname)
//    {
//        // Получаеем имя хоста из переменной "hostname".
//        $this->hostname = $hostname;
//    }
//
//    /**
// * Задаём порт.
// * По - умолчанию используем порты 80 / 443.
// * @param int Порт или FALSE для использования по умолчанию.
//    */
//    public function setPort($port)
//    {
//        // Получаеем номер порта из переменной "port".
//        $this->port = $port;
//    }
//
//    /**
// * Включите или отключите SSL для этого соединения.
// * Это значение влияет на строку подключения для fsockopen().
// * Если включено - добавляем префикс "ssl://".
// * Если установлено значение NULL, значение берётся из переменной $_SERVER['HTTPS'].
// *
// * @param boolean | null Установите TRUE, чтобы включить или FALSE - чтобы отключить,
// * NULL - чтобы определять автоматически.
//    */
//    public function setSSL($enableSSL)
//    {
//        // Получаеем значение ssl из переменной "enableSSL".
//        $this->ssl = $enableSSL;
//    }