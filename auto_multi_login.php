<?php
//#!/usr/bin/env php
//// Из глобального массива "$argv" получаем данные:
//// Получаем логин почтового ящика.
//$user        = $argv['1'];
//
//// Получаем пароль почтового ящика.
//$password    = $argv['2'];
//
//// Получаем глобальную задачу.
//$global_task = $argv['3'];
//
//// Если четвёртый элемент массива "$argv" содержит "1" переменной
//// "$log_file" присвоим "TRUE" - записывать лог-файл действий программы.
//// Иначе "FALSE" - не записывать лог-файл действий программы.
//$log_file    = $argv['4']=='1' ? TRUE : FALSE;
//
//// Если пятый элемент массива "$argv" содержит "1" то переменной "$debug"
//// присвоим "TRUE" - записывать лог-файл с сообщениями отладки.
//// Иначе "FALSE" - не записывать лог-файл с сообщениями отладки.
//$debug = $argv['5']=='1' ? TRUE : FALSE;
//
//// Шестой элемент массива "$argv" содержит строку с окончанием url-адресов
//// WEB-адресов хостов на которых будем выполнять задачу.
//// Функцией "explode()" разобьём строку по разделителю запятая,
//// запишем в массив "urls".
//$urls = explode(',', $argv['6']);
//
//// В цикле перебираем массив "urls" и изменяем значения элементов:
//foreach($urls as $key => &$url){
//  // вставим переменную "url" в общую строку WEB-адреса хоста.
//  $url = 'http://cadmail:10002/rc147-' . $url . '/';
//}

//// Через глобальный массив GET передаём:
//// хост, папку размещения скриптов,
////$host          = $_GET['host'];
////$host_folder   = $_GET['host_folder'];
////  логин для доступа на почтовый аккаунт.
////$user        = $_GET['email'];
////  пароль для доступа на почтовый аккаунт.
////$password    = $_GET['password'];
////  выполняемая задача.
////$global_task = $_GET['global_task'];
//
////$folder_search = $_GET['folder_search'];
//
//// Из глобального массива "$argv" получаем данные.
///**
//* $argv — массив аргументов, которые передали скрипту.
//* Описание:
//*   Переменная содержит массив (array) аргументов, которые передали скрипту
//*   при запуске из командной строки.
//* Замечание:
//*   Первый аргумент $argv[0] содержит название файла запущенного скрипта.
//* Замечание:
//*   Переменная недоступна при отключённой директиве register_argc_argv.
//* Внимание:
//*   Для проверки того, что скрипт запустили из командной строки, вместо
//* проверки факта установки переменных $argv или $_SERVER['argv'] вызывают
//* функцию php_sapi_name().
//*/
//// Получаем логин почтового ящика.
//$login = $argv['1'];
//echo $login . "\n";
//
//// Получаем пароль почтового ящика.
//$password = $argv['2'];
//echo $password . "\n";
//
//// Получаем глобальную задачу.
//$global_task = $argv['3'];
//echo $global_task . "\n";
//
//// Массив содержит WEB-адреса хостов которые будем обрабатывать.
//$urls = Array(
//  //'http://localhost/rc147/',
//  'http://cadmail:10002/rc147-1/',
//  'http://cadmail:10002/rc147-2/',
//  'http://cadmail:10002/rc147-3/'
////  'http://cadmail:10002/rc147-4/',
////  'http://cadmail:10002/rc147-5/',
////  'http://cadmail:10002/rc147-6/',
////  'http://cadmail:10002/rc147-7/',
////  'http://cadmail:10002/rc147-8/',
////  'http://cadmail:10002/rc147-9/',
////  'http://cadmail:10002/rc147-10/',
////  'http://cadmail:10002/rc147-11/',
////  'http://cadmail:10002/rc147-12/',
////  'http://cadmail:10002/rc147-13/',
////  'http://cadmail:10002/rc147-14/',
////  'http://cadmail:10002/rc147-15/',
////  'http://cadmail:10002/rc147-16/',
////  'http://cadmail:10002/rc147-17/',
////  'http://cadmail:10002/rc147-18/',
////  'http://cadmail:10002/rc147-19/',
////  'http://cadmail:10002/rc147-20/',
////  'http://cadmail:10002/rc147-21/',
////  'http://cadmail:10002/rc147-22/',
////  'http://cadmail:10002/rc147-23/',
////  'http://cadmail:10002/rc147-24/',
////  'http://cadmail:10002/rc147-25/',
////  'http://cadmail:10002/rc147-26/',
////  'http://cadmail:10002/rc147-27/',
////  'http://cadmail:10002/rc147-28/',
////  'http://cadmail:10002/rc147-29/',
////  'http://cadmail:10002/rc147-30/',
////  'http://cadmail:10002/rc147-31/',
////  'http://cadmail:10002/rc147-32/',
////  'http://cadmail:10002/rc147-33/',
////  'http://cadmail:10002/rc147-34/',
////  'http://cadmail:10002/rc147-35/',
////  'http://cadmail:10002/rc147-36/',
////  'http://cadmail:10002/rc147-37/',
////  'http://cadmail:10002/rc147-38/',
////  'http://cadmail:10002/rc147-39/',
////  'http://cadmail:10002/rc147-40/',
////  'http://cadmail:10002/rc147-41/',
////  'http://cadmail:10002/rc147-42/',
////  'http://cadmail:10002/rc147-43/',
////  'http://cadmail:10002/rc147-44/',
////  'http://cadmail:10002/rc147-45/',
////  'http://cadmail:10002/rc147-46/',
////  'http://cadmail:10002/rc147-47/',
////  'http://cadmail:10002/rc147-48/',
////  'http://cadmail:10002/rc147-49/',
////  'http://cadmail:10002/rc147-50/'
//);


//// Загружаем файл класса "RoundcubeMultiCURL" - инициируем конструкторы класса.
//require_once(__DIR__ . '/RoundcubeMultiCURL.Class.php');
//
//// Создаём объект:
//// создаём экземпляр класса "RoundcubeMultiCURL" через переменную "$rcMcURL",
//// и передаём следующие параметры:
//// "$user" - логин;
//// "$password" - пароль;
//// массив "$urls" содержит WEB-адреса хостов которые будем обрабатывать;
//// "$global_task" - задача которую будет выполнять WEB-приложение;
//// "$log_file" - если - TRUE - включаем запись действий в лог-файл;
//// "$debug" - если - TRUE - включаем отладку и запись отладки в лог-файл.
//$rcMcURL = new RoundcubeMultiCURL($user, $password, $urls, $global_task, $log_file, $debug);
//
//// Удаляем переменные из памяти.
//unset($user, $password, $urls, $global_task, $log_file, $debug, $argv, $argc);
//
//// Если включен режим записи в лог-файл (writeLogEnabled = TRUE).
//// Вызываем функцию записи сообщения о начале работы программы.
//if($rcMcURL->writeLogEnabled == TRUE) $rcMcURL->start();
//
//// Выполняем авторизацию в Roundcube.
//$rcMcURL->curl_multi_get_auth();
////   создаём экземпляр класса "RoundcubeMultiCURL" через переменную "$rcMcURL",
////   и передаём следующие параметры:
////     массив "$urls" содержит WEB-адреса хостов которые будем обрабатывать;
////     3 параметр: если - TRUE - включаем отладку;
////     4 параметр: если - TRUE - включаем запись отладки в лог-файл.
////$rcMcURL = new RoundcubeMultiCURL($urls, $user, $password, TRUE, TRUE);
//$rcMcURL = new RoundcubeMultiCURL($urls, TRUE, TRUE);
//
//// В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
//// указание записи в лог-файл (writeLogEnabled = TRUE).
//// Вызываем функцию записи в лог-файл.
//if($rcMcURL->writeLogEnabled == TRUE){
//  // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
//  $msg_start = date("Y.m.d") . " ";
//  // Время (17:16:18).
//  $msg_start .= date("H:i:s") . "\t";
//  // Сообщение начала обработки.
//  $msg_start .= "RC multi cURL starting\n";
//  // Выводим сообщение.
//  echo "$msg_start" . "\n";
//  // Вызываем функцию записи в лог-файл.
//  $rcMcURL->write_log_file($msg_start);
//}
//
//// Выполняем установку параметров cURL для авторизации в Roundcube.
//$rcMcURL->curl_multi_set_auth();
//
//// Выполнение парарельных запросов в cURL.
//$rcMcURL->curl_multi_exec();
//
//// Получаем контент авторизации.
////$getcontent = 'auth';
////$rcMcURL->curl_multi_getcontent($getcontent);
//$rcMcURL->curl_multi_getcontent('auth');
//
//// Сбрасываем все установленные опции.
//$rcMcURL->curl_reset($rcMcURL->urls);

//// В цикле выполняем запросы пока объект "$rcMcURL" содержит массив "$curls".
//do{
//  // Выполняем установку параметров cURL для POST-запроса на выполнение
//  // команды WEB-серверу в Roundcube.
//  $rcMcURL->curl_multi_set_request_post();

//  // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
//} while($rcMcURL->curls);
//
//// Если включен режим записи в лог-файл (writeLogEnabled = TRUE).
//// Вызываем функцию записи сообщения о завершении работы программы.
//if($rcMcURL->writeLogEnabled == TRUE) $rcMcURL->stop();
//
//// Удаляем наш объект
//unset($rcMcURL);
//
//// Завершаем работу скрипта.
//exit;
//  // Выполнение парарельных запросов в cURL.
//  // POST-запрос на выполнение команды WEB-серверу:
//  $rcMcURL->curl_multi_exec();
//
//  // Получаем ответ на POST-запрос.
//  //$getcontent = 'post';
//  //$rcMcURL->curl_multi_getcontent($getcontent);
//  $rcMcURL->curl_multi_getcontent('post');
//
//  // Разбираем ответ сервера и в регулярном выражении ищем строку
//  // "X-RM-Processing: yes"
//  foreach($rcMcURL->content_h['post'] as $url=>$response){
//    /**
//    * preg_match — Выполняет проверку на соответствие регулярному выражению.
//    * Ищет в заданном тексте subject совпадения с шаблоном pattern.
//    **/
//    // Получаем строку "X - RM - Processing: yes" из результатов выдачи сервера.
//    preg_match('/^X-RM-Processing:\s(yes)[^\\n]/im', $response, $resultX);
//
//    /**
//    * preg_match_all — Выполняет глобальный поиск шаблона в строке.
//    * Описание:
//    * preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int $offset=0):int|false|null
//    *
//    * Ищет в строке subject все совпадения с шаблоном pattern и помещает
//    * результат в массив matches в порядке,     * определяемом комбинацией
//    * флагов flags.
//    * После нахождения первого соответствия последующие поиски будут
//    * осуществляться не с начала строки, а от конца последнего найденного вхождения.
//    * Список параметров:
//    * @var pattern Искомый шаблон в виде строки.
//    * @var subject Входная строка.
//    * @var matches Массив совпавших значений, отсортированный в соответствии
//    *              с параметром flags.
//    * @var flags   Может быть комбинацией флагов.
//    * @var offset  Обычно поиск осуществляется слева направо, с начала строки.
//    *              Дополнительный параметр offset может быть использован для
//    *              указания альтернативной начальной позиции для поиска.
//    * Замечание:
//    * Использование параметра offset не эквивалентно замене сопоставляемой
//    * строки выражением substr($subject, $offset) при вызове функции
//    * preg_match_all(), поскольку шаблон pattern может содержать такие условия
//    * как ^, $ или (?<=x). Вы можете найти соответствующие примеры в описании
//    * функции preg_match().
//    * Возвращаемые значения:
//    * Возвращает количество найденных вхождений шаблона (которое может быть
//    * и нулём) либо false, если во время выполнения возникли какие-либо ошибки.
//    */
//    // Получаем строку "Set - Cookie" из результатов выдачи сервера.
//    preg_match_all('/^Set-Cookie:.*/im', $response, $resultC);
//
//    /**
//    * Условный оператор ?, возвращает y, в случае если x принимает значение true,
//    * и z в случае, если x принимает значение false. Пример: x ? y : z.
//    */
//    // Если массив "$resultX" сформирован - то переменной "$processing"
//    // присвоим TRUE иначе FALSE.
//    $processing = $resultX ? TRUE : FALSE;
//    // Если массив "$resultC" с элементом "['0']" сформирован - то переменной
//    // "$set_cookie" присвоим TRUE иначе FALSE.
//    $set_cookie = $resultC['0'] ? TRUE : FALSE;
//
//    // Если переменные "$processing" и "$set_cookie" равны FALSE:
//    if($processing == FALSE & $set_cookie == FALSE){
//      // В массив "$del_urls" добавляем адрес домена который нужно
//      // исключить из обработки.
//      $del_urls[$url] = $url;
//    }
//
//    // Если переменная "$set_cookie" равна TRUE:
//    if($set_cookie == TRUE){
//      // В терминал выводим сообщение о выполнении процедуры
//      // перерегистрации в Roundcube:
//      //   дата 2001.03.10 17:16:18 (формат MySQL DATETIME);
//      $new_reg = date("Y.m.d") . " ";
//      //   время (17:16:18);
//      $new_reg .= date("H:i:s") . "\t";
//      //   сообщение;
//      $new_reg .= "RC multi cURL new registration on: $url\n";
//      //   выводим сообщение;
//      echo "$new_reg" . "\n";
//      //   запишем это сообщение в лог-файл;
//      $rcMcURL->write_log_file($new_reg);
//      //   выполняем установку параметров cURL для авторизации в Roundcube;
//      $rcMcURL->curl_multi_set_auth();
//      //   выполнение парарельных запросов в cURL;
//      $rcMcURL->curl_multi_exec();
//      //   получаем контент авторизации;
//      //$getcontent = 'auth';
//      //$rcMcURL->curl_multi_getcontent($getcontent);
//      $rcMcURL->curl_multi_getcontent('auth');
//      //   сбрасываем все установленные опции.
//      $rcMcURL->curl_reset($rcMcURL->urls);
//    }
//    // Удалим переменную вспомогательные массивы.
//    unset($resultC, $resultX, $processing, $set_cookie, $new_reg);
//  }
//
//  // Если массив "$del_urls" сформирован - выполняем функциию выхода из
//  // Roundcube и очистку массивов.
//  if(isset($del_urls)){
//    // Сбрасываем все установленные опции:
//    //   передаём в функцию массив "$del_urls" по которому будем проходить.
//    $rcMcURL->curl_reset($del_urls);
//
//    // GET-запрос на выход.
//    $rcMcURL->curl_multi_set_get_aut($del_urls);
//
//    // Выполнение парарельных запросов в cURL.
//    $rcMcURL->curl_multi_exec();
//
//    // Получим значение массивов по ссылке через & из объекта "$rcMcURL".
//    $rc_curls     = & $rcMcURL->curls;
//    $rc_tokens    = & $rcMcURL->tokens;
//    $rc_content_h = & $rcMcURL->content_h;
//    $rc_urls      = & $rcMcURL->urls;
//
//    // Инициализируем переменную-счётчик для уменьшения колличества url
//    // в обработке.
//    // Переменной "$runing_urls" присвоим колличество URLs в обработке
//    // на данный момент.
//    $runing_urls  = (count($rcMcURL->urls));
//
//    // В цикле удаляем не нужные нам адреса
//    foreach($del_urls as $url){
//      // Уменьшим нашу переменную - счётчик на единицу.
//      $runing_urls--;
//
//      // В условии проверяем если включен режим отладки
//      // (debugEnabled = TRUE) и указание записи в лог-файл
//      // (writeLogEnabled = TRUE): вызываем функцию записи в лог-файл.
//      if($rcMcURL->writeLogEnabled == TRUE){
//        // Сообщение об исключении url из обработки:
//        // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
//        $url_exception = date("Y.m.d") . " ";
//        // Время (17:16:18).
//        $url_exception .= date("H:i:s") . "\t";
//        // Сообщение об окончании обработки.
//        // Добавим новое сообщение к нашему сообщению.
//        $url_exception .= "RC multi cURL exception URL: $url. Runing URLs: $runing_urls\n";
//        // Выводим сообщение.
//        echo "$url_exception" . "\n";
//        // Вызываем функцию записи в лог-файл.
//        $rcMcURL->write_log_file($url_exception);
//      }
//
//      // Закрываем все дескрипторы.
//      curl_multi_remove_handle($rcMcURL->multiCurl, $rc_curls[$url]);
//
//      // Удаляем элемент массива по ключу.
//      unset($rc_curls[$url], $rc_tokens[$url], $rc_content_h['auth'][$url], $rc_content_h['post'][$url]);
//
//      /**
//      * array_search — Осуществляет поиск данного значения в массиве и
//      * возвращает ключ первого найденного элемента в случае успешного выполнения.
//      *
//      * array_search(mixed $needle, array $haystack, bool $strict=false):int|string|false
//      *
//      * Ищет в haystack значение needle.
//      * Список параметров:
//      * @var needle   Искомое значение.
//      *               Замечание:
//      *               Если needle является строкой, сравнение происходит
//      *               с учётом регистра.
//      * @var haystack Массив.
//      * @var strict   Если третий параметр strict установлен в true, то
//      *               функция array_search() будет искать идентичные
//      *               элементы в haystack. Это означает, что также будут
//      * проверяться типы needle в haystack, а объекты должны быть одним
//      * и тем же экземпляром.
//      * Возвращаемые значения:
//      * Возвращает ключ для needle, если он был найден в массиве, иначе false.
//      * Если needle присутствует в haystack более одного раза, будет возвращён
//      * первый найденный ключ. Для того, чтобы возвратить ключи для всех
//      * найденных значений, используйте функцию array_keys() с необязательным
//      * параметром search_value.
//      */
//      unset($rc_urls[array_search($url, $rc_urls)]);
//    }
//    // Удалим массив "$del_urls".
//    unset($del_urls);
//  }
//  // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
//} while($rcMcURL->curls);
//
//// Закрываем набор cURL-дескрипторов.
//$rcMcURL->curl_multi_close();
//
//// Сообщение об окончании работы программы.
//// В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
//// указание записи в лог-файл (writeLogEnabled == TRUE):
//// вызываем функцию записи в лог-файл.
//if($rcMcURL->writeLogEnabled == TRUE){
//  // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
//  $msg_stop = date("Y.m.d") . " ";
//  // Время (17:16:18).
//  $msg_stop .= date("H:i:s") . "\t";
//  // Сообщение об окончании обработки.
//  $msg_stop .= "RC multi cURL stopping\n";
//  // Выводим сообщение.
//  echo "$msg_stop" . "\n";
//  // Вызываем функцию записи в лог-файл.
//  $rcMcURL->write_log_file($msg_stop);
//}

#!/usr/bin/env php
// Из глобального массива "$argv" получаем данные:
// Получаем логин почтового ящика.
$user        = $argv['1'];

// Получаем пароль почтового ящика.
$password    = $argv['2'];

// Получаем глобальную задачу.
$global_task = $argv['3'];

// Если четвёртый элемент массива "$argv" содержит "1" переменной
// "$log_file" присвоим "TRUE" - записывать лог-файл действий программы.
// Иначе "FALSE" - не записывать лог-файл действий программы.
<<<<<<< HEAD
<<<<<<< HEAD
$log_file    = $argv['4']=='1' ? TRUE : FALSE;
=======
$log_file = $argv['4']=='1' ? TRUE : FALSE;
>>>>>>> 1efd051... Рабочий вариант для отправки на сервер. С комментариями старого кода.
=======
$log_file    = $argv['4']=='1' ? TRUE : FALSE;
>>>>>>> c15c671... Рабочий вариант для отправки на сервер.

// Если пятый элемент массива "$argv" содержит "1" то переменной "$debug"
// присвоим "TRUE" - записывать лог-файл с сообщениями отладки.
// Иначе "FALSE" - не записывать лог-файл с сообщениями отладки.
$debug = $argv['5']=='1' ? TRUE : FALSE;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 0985313... Рабочий вариант для отправки на сервер.
// Шестой элемент массива "$argv" содержит строку с окончанием url-адресов
// WEB-адресов хостов на которых будем выполнять задачу.
// Функцией "explode()" разобьём строку по разделителю запятая,
// запишем в массив "urls".
$urls = explode(',', $argv['6']);

// В цикле перебираем массив "urls" и изменяем значения элементов:
// вставим переменную "url" в общую строку WEB-адреса хоста.
foreach($urls as $key => &$url){
  $url = 'http://cadmail:10002/rc147-' . $url . '/';
}
<<<<<<< HEAD
=======
// Массив содержит WEB-адреса хостов которые будем обрабатывать.
$urls = Array(
  'http://cadmail:10002/rc147-1/',
  'http://cadmail:10002/rc147-2/',
  'http://cadmail:10002/rc147-3/',
  'http://cadmail:10002/rc147-4/',
  'http://cadmail:10002/rc147-5/',
  'http://cadmail:10002/rc147-6/',
  'http://cadmail:10002/rc147-7/',
  'http://cadmail:10002/rc147-8/',
  'http://cadmail:10002/rc147-9/',
  'http://cadmail:10002/rc147-10/',
  'http://cadmail:10002/rc147-11/',
  'http://cadmail:10002/rc147-12/',
  'http://cadmail:10002/rc147-13/',
  'http://cadmail:10002/rc147-14/',
  'http://cadmail:10002/rc147-15/',
  'http://cadmail:10002/rc147-16/',
  'http://cadmail:10002/rc147-17/',
  'http://cadmail:10002/rc147-18/',
  'http://cadmail:10002/rc147-19/',
  'http://cadmail:10002/rc147-20/',
  'http://cadmail:10002/rc147-21/',
  'http://cadmail:10002/rc147-22/',
  'http://cadmail:10002/rc147-23/',
  'http://cadmail:10002/rc147-24/',
  'http://cadmail:10002/rc147-25/',
  'http://cadmail:10002/rc147-26/',
  'http://cadmail:10002/rc147-27/',
  'http://cadmail:10002/rc147-28/',
  'http://cadmail:10002/rc147-29/',
  'http://cadmail:10002/rc147-30/',
  'http://cadmail:10002/rc147-31/',
  'http://cadmail:10002/rc147-32/',
  'http://cadmail:10002/rc147-33/',
  'http://cadmail:10002/rc147-34/',
  'http://cadmail:10002/rc147-35/',
  'http://cadmail:10002/rc147-36/',
  'http://cadmail:10002/rc147-37/',
  'http://cadmail:10002/rc147-38/',
  'http://cadmail:10002/rc147-39/',
  'http://cadmail:10002/rc147-40/',
  'http://cadmail:10002/rc147-41/',
  'http://cadmail:10002/rc147-42/',
  'http://cadmail:10002/rc147-43/',
  'http://cadmail:10002/rc147-44/',
  'http://cadmail:10002/rc147-45/',
  'http://cadmail:10002/rc147-46/',
  'http://cadmail:10002/rc147-47/',
  'http://cadmail:10002/rc147-48/',
  'http://cadmail:10002/rc147-49/',
  'http://cadmail:10002/rc147-50/'
);
>>>>>>> 1efd051... Рабочий вариант для отправки на сервер. С комментариями старого кода.
=======

<<<<<<< HEAD
//// Массив содержит WEB-адреса хостов которые будем обрабатывать.
//$urls = Array(
////    'http://cadmail:10002/rc147-1/',
////    'http://cadmail:10002/rc147-2/',
////    'http://cadmail:10002/rc147-3/',
////    'http://cadmail:10002/rc147-4/'
////    'http://cadmail:10002/rc147-5/'
////    'http://cadmail:10002/rc147-6/',
////    'http://cadmail:10002/rc147-7/',
////    'http://cadmail:10002/rc147-8/',
////    'http://cadmail:10002/rc147-9/',
////    'http://cadmail:10002/rc147-10/'
//  //  'http://cadmail:10002/rc147-11/',
//  //  'http://cadmail:10002/rc147-12/',
//  //  'http://cadmail:10002/rc147-13/',
//  //  'http://cadmail:10002/rc147-14/',
//  //  'http://cadmail:10002/rc147-15/',
//  //  'http://cadmail:10002/rc147-16/',
//  //  'http://cadmail:10002/rc147-17/',
//  //  'http://cadmail:10002/rc147-18/',
//  //  'http://cadmail:10002/rc147-19/',
//  //  'http://cadmail:10002/rc147-20/',
//  //  'http://cadmail:10002/rc147-21/'
//  //  'http://cadmail:10002/rc147-22/',
//  //  'http://cadmail:10002/rc147-23/',
//  //  'http://cadmail:10002/rc147-24/',
//  //  'http://cadmail:10002/rc147-25/',
//  //  'http://cadmail:10002/rc147-26/',
//  //  'http://cadmail:10002/rc147-27/',
//  //  'http://cadmail:10002/rc147-28/',
//  //  'http://cadmail:10002/rc147-29/',
//  //  'http://cadmail:10002/rc147-30/',
//  //  'http://cadmail:10002/rc147-31/',
//  //  'http://cadmail:10002/rc147-32/',
//  //  'http://cadmail:10002/rc147-33/',
//  //  'http://cadmail:10002/rc147-34/',
//  //  'http://cadmail:10002/rc147-35/',
//  //  'http://cadmail:10002/rc147-36/',
//  //  'http://cadmail:10002/rc147-37/',
//  //  'http://cadmail:10002/rc147-38/',
//  //  'http://cadmail:10002/rc147-39/',
//  //  'http://cadmail:10002/rc147-40/',
//  //  'http://cadmail:10002/rc147-41/',
//  //  'http://cadmail:10002/rc147-42/',
//  //  'http://cadmail:10002/rc147-43/',
//  //  'http://cadmail:10002/rc147-44/',
//  //  'http://cadmail:10002/rc147-45/',
//  //  'http://cadmail:10002/rc147-46/',
//  //  'http://cadmail:10002/rc147-47/',
//  //  'http://cadmail:10002/rc147-48/',
//  //  'http://cadmail:10002/rc147-49/',
//  //  'http://cadmail:10002/rc147-50/'
//);
>>>>>>> 0985313... Рабочий вариант для отправки на сервер.

=======
>>>>>>> 053ebdb... Рабочий вариант для отправки на сервер.
// Загружаем файл класса "RoundcubeMultiCURL" - инициируем конструкторы класса.
require_once(__DIR__ . '/RoundcubeMultiCURL.Class.php');

// Создаём объект:
// создаём экземпляр класса "RoundcubeMultiCURL" через переменную "$rcMcURL",
// и передаём следующие параметры:
// "$user" - логин;
// "$password" - пароль;
// массив "$urls" содержит WEB-адреса хостов которые будем обрабатывать;
// "$global_task" - задача которую будет выполнять WEB-приложение;
// "$log_file" - если - TRUE - включаем запись действий в лог-файл;
// "$debug" - если - TRUE - включаем отладку и запись отладки в лог-файл.
$rcMcURL = new RoundcubeMultiCURL($user, $password, $urls, $global_task, $log_file, $debug);

// Удаляем переменные из памяти.
unset($user, $password, $urls, $global_task, $log_file, $debug, $argv, $argc);

// Если включен режим записи в лог-файл (writeLogEnabled = TRUE).
// Вызываем функцию записи сообщения о начале работы программы.
if($rcMcURL->writeLogEnabled == TRUE) $rcMcURL->start();

// Выполняем авторизацию в Roundcube.
$rcMcURL->curl_multi_get_auth();

// В цикле выполняем запросы пока объект "$rcMcURL" содержит массив "$curls".
do{
  // Выполняем установку параметров cURL для POST-запроса на выполнение
  // команды WEB-серверу в Roundcube.
  $rcMcURL->curl_multi_set_request_post();

  // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
} while($rcMcURL->curls);
<<<<<<< HEAD

// Если включен режим записи в лог-файл (writeLogEnabled = TRUE).
// Вызываем функцию записи сообщения о завершении работы программы.
if($rcMcURL->writeLogEnabled == TRUE) $rcMcURL->stop();

// Удаляем наш объект
unset($rcMcURL);

// Завершаем работу скрипта.
exit;
?>
=======

// Если включен режим записи в лог-файл (writeLogEnabled = TRUE).
// Вызываем функцию записи сообщения о завершении работы программы.
if($rcMcURL->writeLogEnabled == TRUE) $rcMcURL->stop();

// Удаляем наш объект
unset($rcMcURL);

// Завершаем работу скрипта.
exit;

// Выполнение парарельных запросов в cURL.
//$rcMcURL->curl_multi_exec();

// Получаем контент авторизации.
//$getcontent = 'auth';
//$rcMcURL->curl_multi_getcontent($getcontent);
//$rcMcURL->curl_multi_getcontent('auth');

//// Если включен режим отладки (debugEnabled = TRUE).
//if($rcMcURL->debugEnabled == TRUE){
// echo 'rcMcURL->content_h[auth]: ', "\n";
// var_dump($rcMcURL->content_h['auth']);
//}

// Сбрасываем все установленные опции.
//$rcMcURL->curl_reset($rcMcURL->urls);

//// В цикле выполняем запросы пока объект "$rcMcURL" содержит массив "$curls".
//do{
<<<<<<< HEAD
// // Выполняем установку параметров cURL для POST-запроса на выполнение
// // команды WEB-серверу в Roundcube.
// $rcMcURL->curl_multi_set_request_post();
//
// // Выполнение парарельных запросов в cURL.
// // POST-запрос на выполнение команды WEB-серверу:
// $rcMcURL->curl_multi_exec();
//
// // Получаем ответ на POST-запрос.
// //$getcontent = 'post';
// //$rcMcURL->curl_multi_getcontent($getcontent);
// $rcMcURL->curl_multi_getcontent('post');
//
// // Разбираем массив - ответ сервера регулярным выражении ищем строку
// // "X-RM-Processing: yes"
// foreach($rcMcURL->content_h['post'] as $url=>$response){
// /**
// * preg_match — Выполняет проверку на соответствие регулярному выражению.
// * Ищет в заданном тексте subject совпадения с шаблоном pattern.
// **/
// // Получаем строку "X - RM - Processing: yes" из результатов выдачи сервера.
// preg_match('/^X-RM-Processing:\s(yes)[^\\n]/im', $response, $resultX);
//
// /**
// * preg_match_all — Выполняет глобальный поиск шаблона в строке.
// * Описание:
// * preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int
$offset=0):int|false|null
// *
// * Ищет в строке subject все совпадения с шаблоном pattern и помещает
// * результат в массив matches в порядке, * определяемом комбинацией
// * флагов flags.
// * После нахождения первого соответствия последующие поиски будут
// * осуществляться не с начала строки, а от конца последнего найденного вхождения.
// * Список параметров:
// * @var pattern Искомый шаблон в виде строки.
// * @var subject Входная строка.
// * @var matches Массив совпавших значений, отсортированный в соответствии
// * с параметром flags.
// * @var flags Может быть комбинацией флагов.
// * @var offset Обычно поиск осуществляется слева направо, с начала строки.
// * Дополнительный параметр offset может быть использован для
// * указания альтернативной начальной позиции для поиска.
// * Замечание:
// * Использование параметра offset не эквивалентно замене сопоставляемой
// * строки выражением substr($subject, $offset) при вызове функции
// * preg_match_all(), поскольку шаблон pattern может содержать такие условия
// * как ^, $ или (?<=x). Вы можете найти соответствующие примеры в описании // * функции preg_match(). // *
    Возвращаемые значения: // * Возвращает количество найденных вхождений шаблона (которое может быть // * и нулём) либо
    false, если во время выполнения возникли какие-либо ошибки. // */ // // Получаем строку "Set-Cookie" из результатов
    выдачи сервера. // preg_match_all('/^Set-Cookie:.*/im', $response, $resultC); // /** // * Условный оператор ?,
    возвращает y, в случае если x принимает значение true, // * и z в случае, если x принимает значение false. Пример: x
    ? y : z. // */ // // Если массив "$resultX" сформирован - то переменной "$processing" // // присвоим TRUE иначе
    FALSE. // $processing=$resultX ? TRUE : FALSE; // // Если массив "$resultC" с элементом "['0']" сформирован - то
    переменной // // "$set_cookie" присвоим TRUE иначе FALSE. // $set_cookie=$resultC['0'] ? TRUE : FALSE; // // // Если
    переменные "$processing" и "$set_cookie" равны FALSE: // if($processing==FALSE & $set_cookie==FALSE){ // // В
    массив "$del_urls" добавляем адрес домена который нужно // // исключить из обработки. // $del_urls[$url]=$url; // }
    // // // Если переменная "$set_cookie" равна TRUE: // if($set_cookie==TRUE){ // // В терминал выводим сообщение о
    выполнении процедуры // // перерегистрации в Roundcube: // // дата 2001.03.10 17:16:18 (формат MySQL DATETIME); //
    $new_reg=date("Y.m.d") . " " ; // // время (17:16:18); // $new_reg .=date("H:i:s") . "\t" ; // // сообщение; //
    $new_reg .="RC multi cURL new registration on: $url \n" ; // // выводим сообщение; // echo "$new_reg" . "\n" ; // //
    запишем это сообщение в лог-файл; // $rcMcURL->write_log_file($new_reg);
    // // выполняем установку параметров cURL для авторизации в Roundcube;
    // $rcMcURL->curl_multi_get_auth();
    // // выполнение парарельных запросов в cURL;
    // $rcMcURL->curl_multi_exec();
    // // получаем контент авторизации;
    // //$getcontent = 'auth';
    // //$rcMcURL->curl_multi_getcontent($getcontent);
    // $rcMcURL->curl_multi_getcontent('auth');
    // // сбрасываем все установленные опции.
    // $rcMcURL->curl_reset($rcMcURL->urls);
    // }
    // // Удалим переменную вспомогательные массивы.
    // unset($resultC, $resultX, $processing, $set_cookie, $new_reg);
    // }
    //
    // // Если массив "$del_urls" сформирован - выполняем функциию выхода из
    // // Roundcube и очистку массивов.
    // if(isset($del_urls)){
    // // Сбрасываем все установленные опции:
    // // передаём в функцию массив "$del_urls" по которому будем проходить.
    // $rcMcURL->curl_reset($del_urls);
    //
    // // GET-запрос на выход.
    // $rcMcURL->curl_multi_set_get_aut($del_urls);
    //
    // // Выполнение парарельных запросов в cURL.
    // $rcMcURL->curl_multi_exec();
    //
    // // Получим значение массивов по ссылке через & из объекта "$rcMcURL".
    // $rc_curls = & $rcMcURL->curls;
    // $rc_tokens = & $rcMcURL->tokens;
    // $rc_content_h = & $rcMcURL->content_h;
    // $rc_urls = & $rcMcURL->urls;
    //
    // // Инициализируем переменную-счётчик для уменьшения колличества url
    // // в обработке.
    // // Переменной "$runing_urls" присвоим колличество URLs в обработке
    // // на данный момент.
    // $runing_urls = (count($rcMcURL->urls));
    //
    // // В цикле удаляем не нужные нам адреса
    // foreach($del_urls as $url){
    // // Уменьшим нашу переменную - счётчик на единицу.
    // $runing_urls--;
    //
    // // В условии проверяем если включен режим отладки
    // // (debugEnabled = TRUE) и указание записи в лог-файл
    // // (writeLogEnabled = TRUE): вызываем функцию записи в лог-файл.
    // if($rcMcURL->writeLogEnabled == TRUE){
    // // Сообщение об исключении url из обработки:
    // // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
    // $url_exception = date("Y.m.d") . " ";
    // // Время (17:16:18).
    // $url_exception .= date("H:i:s") . "\t";
    // // Сообщение об окончании обработки.
    // // Добавим новое сообщение к нашему сообщению.
    // $url_exception .= "RC multi cURL exception URL: $url. Runing URLs: $runing_urls\n";
    // // Выводим сообщение.
    // echo "$url_exception" . "\n";
    // // Вызываем функцию записи в лог-файл.
    // $rcMcURL->write_log_file($url_exception);
    // }
    //
    // // Закрываем все дескрипторы.
    // curl_multi_remove_handle($rcMcURL->multiCurl, $rc_curls[$url]);
    //
    // // Удаляем элемент массива по ключу.
    // unset($rc_curls[$url], $rc_tokens[$url], $rc_content_h['auth'][$url], $rc_content_h['post'][$url]);
    //
    // /**
    // * array_search — Осуществляет поиск данного значения в массиве и
    // * возвращает ключ первого найденного элемента в случае успешного выполнения.
    // *
    // * array_search(mixed $needle, array $haystack, bool $strict=false):int|string|false
    // *
    // * Ищет в haystack значение needle.
    // * Список параметров:
    // * @var needle Искомое значение.
    // * Замечание:
    // * Если needle является строкой, сравнение происходит
    // * с учётом регистра.
    // * @var haystack Массив.
    // * @var strict Если третий параметр strict установлен в true, то
    // * функция array_search() будет искать идентичные
    // * элементы в haystack. Это означает, что также будут
    // * проверяться типы needle в haystack, а объекты должны быть одним
    // * и тем же экземпляром.
    // * Возвращаемые значения:
    // * Возвращает ключ для needle, если он был найден в массиве, иначе false.
    // * Если needle присутствует в haystack более одного раза, будет возвращён
    // * первый найденный ключ. Для того, чтобы возвратить ключи для всех
    // * найденных значений, используйте функцию array_keys() с необязательным
    // * параметром search_value.
    // */
    // unset($rc_urls[array_search($url, $rc_urls)]);
    // }
    // // Удалим массив "$del_urls".
    // unset($del_urls);
    // }
    //
    // // Если включен режим отладки (debugEnabled = TRUE).
    // if($rcMcURL->debugEnabled == TRUE){
    // // Формируем массив с сообщениями отладки.
    // $msgDebug = array(
    // // Отладочная информация работы приложения:
    // 'debug'=> "Отладочная информация работы приложения:",
    // // Получаем строку "X - RM - Processing: yes"
    // // из результатов выдачи сервера.
    // '1. X-RM-Processing:'=> @$resultX ? $resultX : NULL
    // );
    // // Вызываем функцию записи в лог-файл отладки.
    // $rcMcURL->write_log_file($msgDebug);
    // }
    //
    // // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
    //} while($rcMcURL->curls);
    //
    //// Закрываем набор cURL-дескрипторов.
    //$rcMcURL->curl_multi_close();
    //
    ///**
    //* Получение информации об ошибках и исключениях.
    //* Интерфейс Throwable предоставляет ряд методов, которые позволяют получить
    //* некоторую информацию о возникшем исключении:
    //* getMessage(): возвращает сообщение об ошибке
    //* getCode(): возвращает код исключения
    //* getFile(): возвращает название файла, в котором возникла ошибка
    //* getLine(): возвращает номер строки, в которой возникла ошибка
    //* getTrace(): возвращает трассировку стека
    //* getTraceAsString(): возвращает трассировку стека в виде строки
    //*/
    ////} catch(Exception $e){
    //// echo 'Сообщение об ошибке: ', $e->getMessage(), "\n";
    //// echo 'Код исключения: ', $e->getCode(), "\n";
    //// echo 'Название файла: ', $e->getFile(), "\n";
    //// echo 'Номер строки: ', $e->getLine(), "\n";
    //// echo 'Трассировка стека: ', $e->getTrace(), "\n";
    //// echo 'Трассировка стека в виде строки: ', $e->getTraceAsString(), "\n";
    ////}catch(ParseError $p){
    //// echo 'Сообщение об ошибке: ', $e->getMessage(), "\n";
    //// echo 'Код исключения: ', $e->getCode(), "\n";
    //// echo 'Название файла: ', $e->getFile(), "\n";
    //// echo 'Номер строки: ', $e->getLine(), "\n";
    //// echo 'Трассировка стека: ', $e->getTrace(), "\n";
    //// echo 'Трассировка стека в виде строки: ', $e->getTraceAsString(), "\n";
    ////}
    //// Сообщение об окончании работы программы.
    //// В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
    //// указание записи в лог-файл (writeLogEnabled == TRUE):
    //// вызываем функцию записи в лог-файл.
    //if($rcMcURL->writeLogEnabled == TRUE){
    // // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
    // $msg_stop = date("Y.m.d") . " ";
    // // Время (17:16:18).
    // $msg_stop .= date("H:i:s") . "\t";
    // // Сообщение об окончании обработки.
    // $msg_stop .= "RC multi cURL stopping\n";
    // // Выводим сообщение.
    // echo "$msg_stop" . "\n";
    // // Вызываем функцию записи в лог-файл.
    // $rcMcURL->write_log_file($msg_stop);
    //}
    <<<<<<< HEAD // Сообщение об окончании работы программы. // В условии проверяем если включен режим отладки
        (debugEnabled=TRUE) и // указание записи в лог-файл (writeLogEnabled==TRUE): // вызываем функцию записи в
        лог-файл. if($rcMcURL->writeLogEnabled == TRUE){
        // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
        $msg_stop = date("Y.m.d") . " ";
        // Время (17:16:18).
        $msg_stop .= date("H:i:s") . "\t";
        // Сообщение об окончании обработки.
        $msg_stop .= "RC multi cURL stopping\n";
        // Выводим сообщение.
        echo "$msg_stop" . "\n";
        // Вызываем функцию записи в лог-файл.
        $rcMcURL->write_log_file($msg_stop);
        }
        >>>>>>> df3a68c... Рабочая версия перед отправкой
        =======
        //exit;
        >>>>>>> fe8c57f... Рабочий вариант для отправки на сервер.
        ?>
        >>>>>>> 1efd051... Рабочий вариант для отправки на сервер. С комментариями старого кода.
=======
//  // Выполняем установку параметров cURL для POST-запроса на выполнение
//  // команды WEB-серверу в Roundcube.
//  $rcMcURL->curl_multi_set_request_post();
//
//  // Выполнение парарельных запросов в cURL.
//  // POST-запрос на выполнение команды WEB-серверу:
//  $rcMcURL->curl_multi_exec();
//
//  // Получаем ответ на POST-запрос.
//  //$getcontent = 'post';
//  //$rcMcURL->curl_multi_getcontent($getcontent);
//  $rcMcURL->curl_multi_getcontent('post');
//
//  // Разбираем массив - ответ сервера регулярным выражении ищем строку
//  // "X-RM-Processing: yes"
//  foreach($rcMcURL->content_h['post'] as $url=>$response){
//    /**
//    * preg_match — Выполняет проверку на соответствие регулярному выражению.
//    * Ищет в заданном тексте subject совпадения с шаблоном pattern.
//    **/
//    // Получаем строку "X - RM - Processing: yes" из результатов выдачи сервера.
//    preg_match('/^X-RM-Processing:\s(yes)[^\\n]/im', $response, $resultX);
//
//    /**
//    * preg_match_all — Выполняет глобальный поиск шаблона в строке.
//    * Описание:
//    * preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int $offset=0):int|false|null
//    *
//    * Ищет в строке subject все совпадения с шаблоном pattern и помещает
//    * результат в массив matches в порядке,     * определяемом комбинацией
//    * флагов flags.
//    * После нахождения первого соответствия последующие поиски будут
//    * осуществляться не с начала строки, а от конца последнего найденного вхождения.
//    * Список параметров:
//    * @var pattern Искомый шаблон в виде строки.
//    * @var subject Входная строка.
//    * @var matches Массив совпавших значений, отсортированный в соответствии
//    *              с параметром flags.
//    * @var flags   Может быть комбинацией флагов.
//    * @var offset  Обычно поиск осуществляется слева направо, с начала строки.
//    *              Дополнительный параметр offset может быть использован для
//    *              указания альтернативной начальной позиции для поиска.
//    * Замечание:
//    * Использование параметра offset не эквивалентно замене сопоставляемой
//    * строки выражением substr($subject, $offset) при вызове функции
//    * preg_match_all(), поскольку шаблон pattern может содержать такие условия
//    * как ^, $ или (?<=x). Вы можете найти соответствующие примеры в описании
//    * функции preg_match().
//    * Возвращаемые значения:
//    * Возвращает количество найденных вхождений шаблона (которое может быть
//    * и нулём) либо false, если во время выполнения возникли какие-либо ошибки.
//    */
//    // Получаем строку "Set-Cookie" из результатов выдачи сервера.
//    preg_match_all('/^Set-Cookie:.*/im', $response, $resultC);
//    /**
//    * Условный оператор ?, возвращает y, в случае если x принимает значение true,
//    * и z в случае, если x принимает значение false. Пример: x ? y : z.
//    */
//    // Если массив "$resultX" сформирован - то переменной "$processing"
//    // присвоим TRUE иначе FALSE.
//    $processing = $resultX ? TRUE : FALSE;
//    // Если массив "$resultC" с элементом "['0']" сформирован - то переменной
//    // "$set_cookie" присвоим TRUE иначе FALSE.
//    $set_cookie = $resultC['0'] ? TRUE : FALSE;
//
//    // Если переменные "$processing" и "$set_cookie" равны FALSE:
//    if($processing == FALSE & $set_cookie == FALSE){
//      // В массив "$del_urls" добавляем адрес домена который нужно
//      // исключить из обработки.
//      $del_urls[$url] = $url;
//    }
//
//    // Если переменная "$set_cookie" равна TRUE:
//    if($set_cookie == TRUE){
//      // В терминал выводим сообщение о выполнении процедуры
//      // перерегистрации в Roundcube:
//      //   дата 2001.03.10 17:16:18 (формат MySQL DATETIME);
//      $new_reg = date("Y.m.d") . " ";
//      //   время (17:16:18);
//      $new_reg .= date("H:i:s") . "\t";
//      //   сообщение;
//      $new_reg .= "RC multi cURL new registration on: $url \n";
//      //   выводим сообщение;
//      echo "$new_reg" . "\n";
//      //   запишем это сообщение в лог-файл;
//      $rcMcURL->write_log_file($new_reg);
//      //   выполняем установку параметров cURL для авторизации в Roundcube;
//      $rcMcURL->curl_multi_get_auth();
//      //   выполнение парарельных запросов в cURL;
//      $rcMcURL->curl_multi_exec();
//      //   получаем контент авторизации;
//      //$getcontent = 'auth';
//      //$rcMcURL->curl_multi_getcontent($getcontent);
//      $rcMcURL->curl_multi_getcontent('auth');
//      //   сбрасываем все установленные опции.
//      $rcMcURL->curl_reset($rcMcURL->urls);
//    }
//    // Удалим переменную вспомогательные массивы.
//    unset($resultC, $resultX, $processing, $set_cookie, $new_reg);
//  }
//
//  // Если массив "$del_urls" сформирован - выполняем функциию выхода из
//  // Roundcube и очистку массивов.
//  if(isset($del_urls)){
//    // Сбрасываем все установленные опции:
//    //   передаём в функцию массив "$del_urls" по которому будем проходить.
//    $rcMcURL->curl_reset($del_urls);
//
//    // GET-запрос на выход.
//    $rcMcURL->curl_multi_set_get_aut($del_urls);
//
//    // Выполнение парарельных запросов в cURL.
//    $rcMcURL->curl_multi_exec();
//
//    // Получим значение массивов по ссылке через & из объекта "$rcMcURL".
//    $rc_curls     = & $rcMcURL->curls;
//    $rc_tokens    = & $rcMcURL->tokens;
//    $rc_content_h = & $rcMcURL->content_h;
//    $rc_urls      = & $rcMcURL->urls;
//
//    // Инициализируем переменную-счётчик для уменьшения колличества url
//    // в обработке.
//    // Переменной "$runing_urls" присвоим колличество URLs в обработке
//    // на данный момент.
//    $runing_urls  = (count($rcMcURL->urls));
//
//    // В цикле удаляем не нужные нам адреса
//    foreach($del_urls as $url){
//      // Уменьшим нашу переменную - счётчик на единицу.
//      $runing_urls--;
//
//      // В условии проверяем если включен режим отладки
//      // (debugEnabled = TRUE) и указание записи в лог-файл
//      // (writeLogEnabled = TRUE): вызываем функцию записи в лог-файл.
//      if($rcMcURL->writeLogEnabled == TRUE){
//        // Сообщение об исключении url из обработки:
//        // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
//        $url_exception = date("Y.m.d") . " ";
//        // Время (17:16:18).
//        $url_exception .= date("H:i:s") . "\t";
//        // Сообщение об окончании обработки.
//        // Добавим новое сообщение к нашему сообщению.
//        $url_exception .= "RC multi cURL exception URL: $url. Runing URLs: $runing_urls\n";
//        // Выводим сообщение.
//        echo "$url_exception" . "\n";
//        // Вызываем функцию записи в лог-файл.
//        $rcMcURL->write_log_file($url_exception);
//      }
//
//      // Закрываем все дескрипторы.
//      curl_multi_remove_handle($rcMcURL->multiCurl, $rc_curls[$url]);
//
//      // Удаляем элемент массива по ключу.
//      unset($rc_curls[$url], $rc_tokens[$url], $rc_content_h['auth'][$url], $rc_content_h['post'][$url]);
//
//      /**
//      * array_search — Осуществляет поиск данного значения в массиве и
//      * возвращает ключ первого найденного элемента в случае успешного выполнения.
//      *
//      * array_search(mixed $needle, array $haystack, bool $strict=false):int|string|false
//      *
//      * Ищет в haystack значение needle.
//      * Список параметров:
//      * @var needle   Искомое значение.
//      *               Замечание:
//      *               Если needle является строкой, сравнение происходит
//      *               с учётом регистра.
//      * @var haystack Массив.
//      * @var strict   Если третий параметр strict установлен в true, то
//      *               функция array_search() будет искать идентичные
//      *               элементы в haystack. Это означает, что также будут
//      * проверяться типы needle в haystack, а объекты должны быть одним
//      * и тем же экземпляром.
//      * Возвращаемые значения:
//      * Возвращает ключ для needle, если он был найден в массиве, иначе false.
//      * Если needle присутствует в haystack более одного раза, будет возвращён
//      * первый найденный ключ. Для того, чтобы возвратить ключи для всех
//      * найденных значений, используйте функцию array_keys() с необязательным
//      * параметром search_value.
//      */
//      unset($rc_urls[array_search($url, $rc_urls)]);
//    }
//    // Удалим массив "$del_urls".
//    unset($del_urls);
//  }
//
//  // Если включен режим отладки (debugEnabled = TRUE).
//  if($rcMcURL->debugEnabled == TRUE){
//    // Формируем массив с сообщениями отладки.
//    $msgDebug = array(
//      // Отладочная информация работы приложения:
//      'debug'=> "Отладочная информация работы приложения:",
//      // Получаем строку "X - RM - Processing: yes"
//      // из результатов выдачи сервера.
//      '1. X-RM-Processing:'=> @$resultX ? $resultX : NULL
//    );
//    // Вызываем функцию записи в лог-файл отладки.
//    $rcMcURL->write_log_file($msgDebug);
//  }
//
//  // Пока в объекте "$rcMcURL" существует массив "$curls" выполняем тело цикла.
//} while($rcMcURL->curls);
//
//// Закрываем набор cURL-дескрипторов.
//$rcMcURL->curl_multi_close();
//
///**
//* Получение информации об ошибках и исключениях.
//* Интерфейс Throwable предоставляет ряд методов, которые позволяют получить
//* некоторую информацию о возникшем исключении:
//* getMessage(): возвращает сообщение об ошибке
//* getCode(): возвращает код исключения
//* getFile(): возвращает название файла, в котором возникла ошибка
//* getLine(): возвращает номер строки, в которой возникла ошибка
//* getTrace(): возвращает трассировку стека
//* getTraceAsString(): возвращает трассировку стека в виде строки
//*/
////} catch(Exception $e){
////  echo 'Сообщение об ошибке: ', $e->getMessage(), "\n";
////  echo 'Код исключения: ', $e->getCode(), "\n";
////  echo 'Название файла: ', $e->getFile(), "\n";
////  echo 'Номер строки: ', $e->getLine(), "\n";
////  echo 'Трассировка стека: ', $e->getTrace(), "\n";
////  echo 'Трассировка стека в виде строки: ', $e->getTraceAsString(), "\n";
////}catch(ParseError $p){
////  echo 'Сообщение об ошибке: ', $e->getMessage(), "\n";
////  echo 'Код исключения: ', $e->getCode(), "\n";
////  echo 'Название файла: ', $e->getFile(), "\n";
////  echo 'Номер строки: ', $e->getLine(), "\n";
////  echo 'Трассировка стека: ', $e->getTrace(), "\n";
////  echo 'Трассировка стека в виде строки: ', $e->getTraceAsString(), "\n";
////}
//// Сообщение об окончании работы программы.
//// В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
//// указание записи в лог-файл (writeLogEnabled == TRUE):
//// вызываем функцию записи в лог-файл.
//if($rcMcURL->writeLogEnabled == TRUE){
//  // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
//  $msg_stop = date("Y.m.d") . " ";
//  // Время (17:16:18).
//  $msg_stop .= date("H:i:s") . "\t";
//  // Сообщение об окончании обработки.
//  $msg_stop .= "RC multi cURL stopping\n";
//  // Выводим сообщение.
//  echo "$msg_stop" . "\n";
//  // Вызываем функцию записи в лог-файл.
//  $rcMcURL->write_log_file($msg_stop);
//}

// Сообщение об окончании работы программы.
// В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
// указание записи в лог-файл (writeLogEnabled == TRUE):
// вызываем функцию записи в лог-файл.
if($rcMcURL->writeLogEnabled == TRUE){
  // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
  $msg_stop = date("Y.m.d") . " ";
  // Время (17:16:18).
  $msg_stop .= date("H:i:s") . "\t";
  // Сообщение об окончании обработки.
  $msg_stop .= "RC multi cURL stopping\n";
  // Выводим сообщение.
  echo "$msg_stop" . "\n";
  // Вызываем функцию записи в лог-файл.
  $rcMcURL->write_log_file($msg_stop);
}

//exit;

?>
>>>>>>> 0985313... Рабочий вариант для отправки на сервер.
