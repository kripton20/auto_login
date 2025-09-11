<?php
// Сигнал начала обработки.
$args_start = "Start ";
// Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
$args_start .= date("Y.m.d") . " ";
// Время (17:16:18).
$args_start .= date("H:i:s") . "\t";
// Выводим сообщение.
echo "$args_start" . "\r\n";

// Логин и пароль для  доступа на почтовый аккаунт.
$user     = 'ocik@niiemp.local';
$password = 'ocik1905niiemp';
//$user = 'l51@niiemp.local';
//$password = 'l51v6249niiemp';

// Массив содержит WEB - адреса хостов которые будем обрабатывать.
$urls     = Array(
    'http://cadmail:10002/rc147-1/',
    'http://cadmail:10002/rc147-2/',
    //'http://cadmail:10002/rc147-3/',
    'http://cadmail:10002/rc147-4/',
    'http://cadmail:10002/rc147-8/',
    'http://cadmail:10002/rc147-9/',
    'http://cadmail:10002/rc147-18/',
    'http://cadmail:10002/rc147-19/'
//    'http://cadmail:10002/rc147-27/',
//    'http://cadmail:10002/rc147-28/',
//    'http://cadmail:10002/rc147-29/',
//    'http://cadmail:10002/rc147-30/',
//    'http://cadmail:10002/rc147-31/',
//    'http://cadmail:10002/rc147-33/',
//    'http://cadmail:10002/rc147-34/',
//    'http://cadmail:10002/rc147-35/',
//    'http://cadmail:10002/rc147-39/',
//    'http://cadmail:10002/rc147-40/',
//    'http://cadmail:10002/rc147-41/',
//    'http://cadmail:10002/rc147-42/',
//    'http://cadmail:10002/rc147-43/'
);

// Загружаем файл класса "RoundcubeMultiCURL" - инициируем конструкторы класса.
require_once(__DIR__ . '/RoundcubeMultiCURL.Class.php');

// Создаём объект:
// Создаём экземпляр класса "RoundcubeMultiCURL" через переменную "$rcMcURL", и передаём следующие параметры:
// Массив содержит WEB - адреса хостов которые будем обрабатывать.
// 1 параметр: если - TRUE - включаем отладку.
// 2 параметр: если - TRUE - включаем запись отладки в лог - файл.
$rcMcURL = new RoundcubeMultiCURL($urls, $user, $password, FALSE, FALSE);

// Выполняем авторизацию и установку параметров cURL.
$rcMcURL->curl_multi_set_auth();

// Выполнение запросов cURL.
$rcMcURL->curl_multi_exec();

// Получаем контент авторизации.
$getcontent = 'auth';
$rcMcURL->curl_multi_getcontent($getcontent);

// Сбрасываем все установленные опции.
$rcMcURL->curl_reset($rcMcURL->urls);

// В цикле выполняем запросы пока объект "$rcMcURL" содержит массив "$curls".
do {
    // Установка параметров на POST - запрос на выполнение команды WEB - серверу.
    $rcMcURL->curl_multi_set_rm_post();

    // Выполнение запросов cURL.
    // POST - запрос на выполнение команды WEB - серверу:
    $rcMcURL->curl_multi_exec();

    // Получаем контент POST - запроса.
    $getcontent = 'post';
    $rcMcURL->curl_multi_getcontent($getcontent);

    // Разбираем ответ сервера и в регулярном выражении ищем строку "X - RM - Processing: yes"
    foreach ($rcMcURL->content_h['post'] as $url=>$response) {
        preg_match('/^X-RM-Processing:\s(yes)[^\\n]/im', $response, $result);
        // Условный оператор ?, возвращает y, в случае если x принимает значение true, и z в случае,
        // если x принимает значение false. Пример: x ? y : z
        $processing = $result ? $result['1'] : NULL;
        // Если переменная "$processing" равна NULL удаляем ресурс - элемент массива "$curls"
        if ($processing == NULL) {
            // В массив "$del_urls" добавляем адресу доменов которые исключаем из обработки.
            $del_urls[$url] = $url;
        }
        // Удалим переменную "$processing".
        unset($processing);
    }

    // Если массив "$del_urls" сформирован - выполняем слудующие функции.
    if (isset($del_urls)) {
        // Сбрасываем все установленные опции: передаём в функцию массив "$del_urls" по которому будем проходить.
        $rcMcURL->curl_reset($del_urls);
        // GET - запрос на выход:
        $rcMcURL->curl_multi_set_get_aut($del_urls);
        // Выполнение запросов cURL.
        $rcMcURL->curl_multi_exec();
        // Получаем контент выхода.
        //$getcontent = 'aut';
        //$rcMcURL->curl_multi_getcontent($getcontent);
        // Получим значение массивов по ссылке через & из объекта "$rcMcURL".
        $rc_curls     = & $rcMcURL->curls;
        $rc_tokens    = & $rcMcURL->tokens;
        $rc_content_h = & $rcMcURL->content_h;
        $rc_urls      = & $rcMcURL->urls;
        // В цикле удаляем не нужные нам адреса
        foreach ($del_urls as $url) {
            curl_multi_remove_handle($rcMcURL->multiCurl, $rc_curls[$url]);
            // Удаляем элемент массива по ключу.
            unset($rc_curls[$url], $rc_tokens[$url], $rc_content_h['auth'][$url], $rc_content_h['post'][$url]);
            /**
            * array_search — Осуществляет поиск данного значения в массиве и возвращает ключ
            * первого найденного элемента в случае успешного выполнения.
            *
            * array_search(mixed $needle, array $haystack, bool $strict=false):int|string|false
            *
            * Ищет в haystack значение needle.
            * Список параметров:
            * @var needle Искомое значение.
            *             Замечание:
            *             Если needle является строкой, сравнение происходит с учётом регистра.
            * @var haystack Массив.
            * @var strict Если третий параметр strict установлен в true, то функция array_search()
            *             будет искать идентичные элементы в haystack. Это означает, что также будут
            *             проверяться типы needle в haystack, а объекты должны быть одним и тем же экземпляром.
            * Возвращаемые значения:
            * Возвращает ключ для needle, если он был найден в массиве, иначе false.
            * Если needle присутствует в haystack более одного раза, будет возвращён первый найденный ключ.
            * Для того, чтобы возвратить ключи для всех найденных значений, используйте функцию array_keys() с
            * необязательным параметром search_value.
            */
            unset($rc_urls[array_search($url, $rc_urls)]);
        }
        // Удалим массив "$del_urls".
        unset($del_urls);
    }
    // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
} while ($rcMcURL->curls);

// Закрываем набор cURL - дескрипторов.
$rcMcURL->curl_multi_close();

// Сигнал окончания обработки.
$args_stop = "Stop  ";
// Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
$args_stop .= date("Y.m.d") . " ";
// Время (17:16:18).
$args_stop .= date("H:i:s") . "\t";
// Выводим сообщение.
echo "$args_stop" . "\r\n";
// Сообщение об окончании работы программы.
exit('Программа "rc_multi_curl" завершила свою работу.' . "\r\n\r\n");
?>
