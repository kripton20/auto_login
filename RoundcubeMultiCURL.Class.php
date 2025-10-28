<?php
class RoundcubeMultiCURL
{
<<<<<<< HEAD
=======

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

>>>>>>> 493de78... Перед построением условий отладки
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
  * Логин.
  * @param string $user
  */
  public $user;

  /**
  * Пароль.
  * @param string $password
  */
  public $password;

  /**
  * Массив WEB-адресов хостов которые будем обрабатывать.
  * @param string $urls
  */
  public $urls;

  /**
  * Выполняемая задача.
  * @param string $global_task
  */
  public $global_task;

  /**
  * Создаём новую сессию: для каждого url.
  * @param array $curls
  */
  public $curls;

  /**
  * Набор дескрипторов cURL.
  * @var string
  * @return resourceID
  */
  public $multiCurl;

  /**
  * Получаем куки с сервера.
  *
  * @param array $cookies
  */
  private $cookies;

  /**
  * Массив полученных токенов от WEB-сервера.
  * @param array $tokens
  */
  public $tokens;

  /**
  * Получаем контент данные GET-запроса на выход отправляемые серверу.
  *
<<<<<<< HEAD
  * @param array $content_get_out_info
=======
  * @param array $content_get_aut_info
>>>>>>> 493de78... Перед построением условий отладки
  */
  private $curl_info;

  /**
  * Получаем контент данные GET-запроса на выход получаемые от сервера.
  *
  * @param array $content_h
  */
  public $content_h;

  /**
<<<<<<< HEAD
  * Включить запись отладки в лог-файл: TRUE в пятом аргументе в
  * конструкторе при создании объекта.
  * @var bool
  */
  public $writeLogEnabled;

  /**
  * Получить отладочную информацию: TRUE в четвёртом аргументе в
  * конструкторе при создании объекта.
  * @var bool
  */
  public $debugEnabled;

  // Создаём класс RoundcubeMultiCURL.
  // // Создаём класс RoundcubeMultiCURL.
  // function __construct($user, $password, $urls, $global_task, $writeLogEnabled = FALSE, $debugEnabled = FALSE){
  //   // Логин.
  //   $this->user = $user;
  //   // Пароль.
  //   $this->password = $password;
  //   // Массив содержит WEB-адреса хостов которые будем обрабатывать.
  //   $this->urls = $urls;
  //   // Выполняемая задача (plugin.msg_request).
  //   $this->global_task = $global_task;
  //   // Создаём новую сессию: для каждого url.
  //   $this->curls = array();

  //   /**
  // * Получить отладочную информацию: TRUE в четвёртом аргументе в
  // * Включить запись отладки в лог-файл: TRUE в пятом аргументе в
  // * >>>>>>> f5efc71... Рабочий вариант для отправки на сервер. С комментариями старого кода.
  // * конструкторе при создании объекта.
  // * @var bool
  // */
  // public $writeLogEnabled;

  // /**
  // * Получить отладочную информацию: TRUE в четвёртом аргументе в
  // * конструкторе при создании объекта.
  // * @var bool
  // */
  // public $debugEnabled;

  // //  /**
  // //  * Запись отладочных сообщений в стёк.
  // //  * @var array
  // //  */
  // //  private $debugStack;

  // Создаём класс RoundcubeMultiCURL.
  function __construct($user, $password, $urls, $global_task, $writeLogEnabled = FALSE, $debugEnabled = FALSE){
    // Логин.
    $this->user = $user;
    // Пароль.
    $this->password = $password;
    // Массив содержит WEB-адреса хостов которые будем обрабатывать.
    $this->urls = $urls;
    // Выполняемая задача (plugin.msg_request).
    $this->global_task = $global_task;
    // Создаём новую сессию: для каждого url.
    $this->curls = array();
=======
  * Получить отладочную информацию: TRUE в четвёртом аргументе в
  * конструкторе при создании объекта.
  * @var bool
  */
  public $debugEnabled;

  /**
  * Запись отладочных сообщений в стёк.
  * @var array
  */
  private $debugStack;

  /**
  * Включить запись отладки в лог-файл: TRUE в пятом аргументе в
  * конструкторе при создании объекта.
  * @var bool
  */
  public $writeLogEnabled;

  /**
  * Создаём новый класс RoundcubeMultiCURL.
  */
  public function __construct($user, $password, $urls, $global_task, $debugEnabled = FALSE, $writeLogEnabled = FALSE)
  {
    // Логин.
    $this->user = $user;
    //$this->user = $_GET['email'];
    // Пароль.
    $this->password = $password;
    //$this->password = $_GET['password'];
    // Массив содержит WEB-адреса хостов которые будем обрабатывать.
    $this->urls = $urls;
    // Выполняемая задача (plugin.msg_request).
    //$this->global_task = $_GET['global_task'];
    $this->global_task = $global_task;
    // Создаём новую сессию: для каждого url.
    $this->curls = array();
    /**
    * curl_multi_init — создаёт набор cURL-дескрипторов.
    * Описание:
    *   curl_multi_init():CurlMultiHandle
    * Позволяет асинхронную обработку множества cURL-дескрипторов.
    * У этой функции нет параметров.
    * Возвращает набор cURL-дескрипторов в случае успешного выполнения
    * или false в случае возникновения ошибки.
    */
>>>>>>> 493de78... Перед построением условий отладки
    // Создаём набор дескрипторов cURL.
    $this->multiCurl = curl_multi_init();
    // Получаем куки с сервера
    $this->cookies = array();
    // Запишем в массив "$tokens" полученные токены.
    $this->tokens = array();
    // Получаем данные отправляемые серверу.
    $this->curl_info = array();
    // Получаем страницу контента от сервера по нашему запросу.
    $this->content_h = array();
<<<<<<< HEAD
    /**
    * curl_multi_init — создаёт набор cURL-дескрипторов.
    * Описание:
    *   curl_multi_init():CurlMultiHandle
    * Позволяет асинхронную обработку множества cURL-дескрипторов.
    * У этой функции нет параметров.
    * Возвращает набор cURL-дескрипторов в случае успешного выполнения
    * или false в случае возникновения ошибки.
    */

    // // Создаём набор дескрипторов cURL.
    // $this->multiCurl = curl_multi_init();
    // // Получаем куки с сервера
    // $this->cookies = array();
    // // Запишем в массив "$tokens" полученные токены.
    // $this->tokens = array();
    // // Получаем данные отправляемые серверу.
    // $this->curl_info = array();
    // // Получаем страницу контента от сервера по нашему запросу.
    // $this->content_h = array();


    // Запись отладочной информации в в лог-файл.
    $this->writeLogEnabled = $writeLogEnabled;
    // Запись отладочной информации в лог-файл.
    $this->debugEnabled = $debugEnabled;

    // Если включен режим отладки (debugEnabled = TRUE).
    if($this->debugEnabled == TRUE){
      // Формируем массив с сообщениями отладки.
      $msgDebug = array(
        // Отладочная информация работы приложения Auto multi login:
        '0. debug'=> "Отладочная информация работы приложения Auto multi login:",
        // Логин.
        '1. user'=> $this->user,
        // Пароль.
        '2. password'=> $this->password,
        // Задача которую будет выполнять WEB-приложение.
        '3. global_task'=> $this->global_task,
        // WEB-адреса хостов которые будем обрабатывать.
        '4. urls'=> $this->urls,
        // Выводим сообщение с названием объекта.
        '5. name_obgect'=> "Объект rcMcURL:",
        // Название объекта.
        '6. rcMcURL'=> $this
      );
      // Вызываем функцию записи в лог-файл отладки.
      $this->write_log_file($msgDebug);
    }
  }

  // Выполняем авторизацию в Roundcube.
  public function curl_multi_get_auth(){
    // Выполняем установку параметров cURL для авторизации в Roundcube.
    // В цикле перебираем элементы массива "$urls" и присвоим параметры
    // сесии cURL.
    foreach($this->urls as $key => $url){

//     // Вывод отладочной информации в браузер.
//     $this->debugEnabled = $debugEnabled;
//     // Инициализируем переменные класса:
//     // Создаём массив для записи отладочных сообщений в стёк.
//     $this->debugStack = array();

// >>>>>>> f5efc71... Рабочий вариант для отправки на сервер. С комментариями старого кода.
    // Запись отладочной информации в  в лог-файл.
=======
<<<<<<< HEAD
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
    // Запись отладочной информации в в лог-файл.
    $this->writeLogEnabled = $writeLogEnabled;
    // Запись отладочной информации в лог-файл.
    $this->debugEnabled = $debugEnabled;

    // Если включен режим отладки (debugEnabled = TRUE).
    if($this->debugEnabled == TRUE){
      // Формируем массив с сообщениями отладки.
      $msgDebug = array(
        // Отладочная информация работы приложения Auto multi login:
        '0. debug'=> "Отладочная информация работы приложения Auto multi login:",
        // Логин.
        '1. user'=> $this->user,
        // Пароль.
        '2. password'=> $this->password,
        // Задача которую будет выполнять WEB-приложение.
        '3. global_task'=> $this->global_task,
        // WEB-адреса хостов которые будем обрабатывать.
        '4. urls'=> $this->urls,
        // Выводим сообщение с названием объекта.
        '5. name_obgect'=> "Объект rcMcURL:",
        // Название объекта.
        '6. rcMcURL'=> $this
      );
      // Вызываем функцию записи в лог-файл отладки.
      $this->write_log_file($msgDebug);
    }
  }

  // Выполняем авторизацию в Roundcube.
  public function curl_multi_get_auth(){
    // Выполняем установку параметров cURL для авторизации в Roundcube.
    // В цикле перебираем элементы массива "$urls" и присвоим параметры
    // сесии cURL.
    foreach($this->urls as $key => $url){
=======
    // Вывод отладочной информации в браузер.
    $this->debugEnabled = $debugEnabled;
    // Инициализируем переменные класса:
    // Создаём массив для записи отладочных сообщений в стёк.
    $this->debugStack = array();
    // Запись отладочной информации в  в лог-файл.
    $this->writeLogEnabled = $writeLogEnabled;
  }

  // Выполняем авторизацию и установку параметров cURL.
  public function curl_multi_set_auth()
  {
    // В цикле перебираем элементы массива "$urls" и присвоим параметры
    // сесии cURL.
    foreach($this->urls as $key=>$url){
>>>>>>> 493de78... Перед построением условий отладки
      // Создаём новую сессию: для каждого url создаем отдельный
      // curl-механизм для отправки запроса.
      $this->curls[$url] = curl_init();
      // Установка URL и других соответствующих параметров:
<<<<<<< HEAD
      // CURLOPT_AUTOREFERER для автоматической установки поля Referer:
      // в запросах, перенаправленных заголовком Location;
      curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
      // CURLOPT_POST для использования обычного HTTP POST.
      // Данный метод POST использует обычный application/x-www-form-urlencoded,
      // обычно используемый в HTML-формах.
      curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
      // CURLOPT_POSTFIELDS Все данные, передаваемые в HTTP POST-запросе.
      // Этот параметр может быть передан как в качестве url-закодированной
      // строки, наподобие 'para1=val1&para2=val2&...', так и в виде массива,
      // ключами которого будут имена полей, а значениями - их содержимое.
      // Если value является массивом, заголовок Content-Type будет
      // установлен в значение multipart/form-data. Файлы можно отправлять
      // с использованием CURLFile или CURLStringFile, в этом случае
      // value должен быть массивом.
      curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $this->user . '&_pass=' . $this->password);
      // CURLOPT_URL Загружаемый URL. Данный параметр может быть также
      // установлен при инициализации сеанса с помощью curl_init().
      curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=login');
      // CURLOPT_VERBOSE Для вывода дополнительной информации.
      // Записывает вывод в поток STDERR, или файл, указанный в
      // параметре CURLOPT_STDERR.
      curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
      // CURLINFO_HEADER_OUT true для отслеживания строки запроса
      // дескриптора.
      curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
      // CURLOPT_HEADER true для включения заголовков в вывод.
      curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
      // CURLOPT_RETURNTRANSFER для возврата результата передачи в
      // качестве строки из curl_exec() вместо прямого вывода в браузер.
      curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
      // CURLOPT_USERAGENT Содержимое заголовка "User-Agent: ",
      // посылаемого в HTTP-запросе.
      curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
      // CURLOPT_FRESH_CONNECT Для принудительного использования нового
      // соединения вместо закешированного.
      curl_setopt($this->curls[$url], CURLOPT_FRESH_CONNECT, TRUE);
      // curl_multi_add_handle Добавляет обычный cURL-дескриптор к
      // набору cURL-дескрипторов:
      // добавляем текущий механизм к числу работающих параллельно.
      curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
    }

    // Если включен режим отладки (debugEnabled = TRUE).
    if($this->debugEnabled == TRUE){
      // Формируем массив с сообщениями отладки.
      $msgDebug = array(
        // Отладочная информация работы приложения Auto multi login:
        '0. debug'=> "Отладочная информация работы приложения Auto multi login:",
        // Новая сессия: для каждого url.
        '1. Новая сессия: для каждого url'=> $this->curls
      );
      // Вызываем функцию записи в лог-файл отладки.
      $this->write_log_file($msgDebug);
    }

    // Выполнение парарельных запросов в cURL.
    $this->curl_multi_exec();

    // Получаем контент на запрос авторизации.
    $this->curl_multi_getcontent('auth');
  }

  // Получаем контент от WEB-сервера. Переменная "$content" показывает
  // из какого раздела массива: "content_h" или "curl_info" мы хотим
  // получить данные.
  function curl_multi_getcontent($content){
    // В цикле перебираем элементы массива "$this->curls"
    // получаем содержимое ответа от сервера.
    foreach($this->curls as $key => $value){
      // Получаем страницу контента от сервера по нашему запросу.
      $this->content_h[$content][$key] = curl_multi_getcontent($this->curls[$key]);
      // Получаем данные отправляемые серверу.
      $this->curl_info[$content][$key] = curl_getinfo($value);

      // Следующий блок работает если переменная "$content" равно "auth".
      if($content == 'auth'){
        // Получаем токен.
        preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $this->content_h[$content][$key], $token);
        // Добавим к массиву "$tokens" полученный токен.
        $this->tokens[$key] = $token['1'];
        // Настройки нашего сервера не позволяют использовать
        // CURLOPT_COOKIEJAR и CURLOPT_COOKIEFILE.
        // Тогда возмём данные Cookie из заголовка ответа сервера используя
        // регулярное выражение "preg_match_all" и функцию "implode":
        // preg_match_all(' / Set - Cookie: (.*); / U', $content, $results);
        // $cookies = implode(';', $results[1]);
        // и установим Cookie с помощью curl_setopt($this->curls, CURLOPT_COOKIE, $cookies);
        // Выполняем глобальный поиск шаблона в строке.
        preg_match_all('/Set-Cookie: (.*);/U', $this->content_h[$content][$key], $results);
        // Получаем куки с сервера.
        $this->cookies[$key] = implode(';', $results[1]);
      }

      // Закрываем и удаляем все дескрипторы из набора.
      curl_multi_remove_handle($this->multiCurl, $this->curls[$key]);
    }

    // Сбрасываем все установленные опции.
    $this->curl_reset($this->urls);

    // Если переменная "$content" равна "post".
    if($content == 'post'){
      // Разбираем массив - ответ сервера регулярным выражении ищем строку
      // "X-RM-Processing: yes"
      foreach($this->content_h['post'] as $url => $response){
        // С помощью регулярного выражения получаем строку
        // "X-RM-Processing: yes" из результатов выдачи сервера.
        preg_match('/^X-RM-Processing:\s(yes)[^\\n]/im', $response, $resultX);

        // С помощью регулярного выражения получаем строку
        // "Set-Cookie" из результатов выдачи сервера.
        preg_match_all('/^Set-Cookie:.*/im', $response, $resultC);

        /**
        * Условный оператор ?, возвращает y, в случае если x принимает
        * значение true,
        * и z в случае, если x принимает значение false. Пример: x ? y : z.
        */
        // Если массив "$resultX" сформирован - то переменной "$processing"
        // присвоим TRUE иначе FALSE.
        $processing = $resultX ? TRUE : FALSE;

        // Если массив "$resultC" с элементом "['0']" сформирован - то переменной
        // "$set_cookie" присвоим TRUE иначе FALSE.
        $set_cookie = $resultC['0'] ? TRUE : FALSE;

        // Если переменные "$processing" и "$set_cookie" равны FALSE:
        // в массив "$del_urls" добавляем адреса доменов которые нужно
        // исключить из обработки.
        if($processing == FALSE & $set_cookie == FALSE) $del_urls[$url] = $url;
        // if($processing == FALSE & $set_cookie == FALSE){
        //   // В массив "$del_urls" добавляем Адреса доменов которые нужно
        //   // исключить из обработки.
        //   $del_urls[$url] = $url;
        // }

        // Если переменная "$set_cookie" равна TRUE:
        if($set_cookie == TRUE){
          // выполняем установку параметров cURL для авторизации в Roundcube;
          $this->curl_multi_get_auth();
          // выполнение парарельных запросов в cURL;
          $this->curl_multi_exec();
          // получаем контент на запрос авторизации;
          $this->curl_multi_getcontent('auth');
          // сбрасываем все установленные опции.
          $this->curl_reset($this->urls);
          // Формируем сообщение о выполнении процедуры
          // перерегистрации в Roundcube:
          // дата 2001.03.10 17:16:18 (формат MySQL DATETIME);
          $new_reg = date("Y.m.d") . " ";
          // время (17:16:18);
          $new_reg .= date("H:i:s") . " ";
          // сообщение;
          $new_reg .= "RC multi cURL new registration on: $url \n";
          // запишем это сообщение в лог-файл;
          $this->write_log_file($new_reg);
        }
        // Удалим вспомогательные переменные и массивы.
        unset($resultC, $resultX, $processing, $set_cookie);
      }
    }

    // Если массив "$del_urls" сформирован - вызываем функциию (GET-запрос)
    // выхода из Roundcube и очистку массивов для указанных url.
    if(isset($del_urls)) $this->curl_multi_set_get_out($del_urls);
    // // Если массив "$del_urls" сформирован - вызываем функциию выхода из
    // // Roundcube и очистку массивов для указанных url .
    // if(isset($del_urls)){
    //   //$this->del_urls($del_urls);
    //   // GET-запрос на выход.
    //   $this->curl_multi_set_get_out($del_urls);
    // }

    // Если включен режим отладки (debugEnabled = TRUE).
    if($this->debugEnabled == TRUE){
      // Формируем массив с сообщениями отладки.
      $msgDebug = array(
        // Отладочная информация работы приложения Auto multi login:
        '0. debug'=> "Отладочная информация работы приложения Auto multi login:",
        // Получаем контент на запрос авторизации.
        '1. getcontent'=> $content,
        // Получаем ответ от сервера.
        '2. response'      => @$response ? $response : NULL,
        // Получаем куки с сервера.
        '3. results'         => @$results ? $results : NULL,
        // Получаем строку "X - RM - Processing: yes"
        // из результатов выдачи сервера.
        '4. X-RM-Processing:'=> @$resultX ? $resultX : NULL,
        // Получаем страницу контента от сервера по нашему запросу.
        '5. content_h'=> $this->content_h,
        // Получаем данные отправляемые серверу.
        '6. curl_info'=> $this->curl_info,
        // Запишем в массив "$tokens" полученные токены.
        '7. tokens'=> $this->tokens,
        // Получаем куки с сервера.
        '8. cookies'         => $this->cookies,
        // Сообщение о перерегистрации.
        '9. Сообщение о перерегистрации'=> @$new_reg ? $new_reg : NULL,
        // Адреса доменов которые нужно исключить из обработки.
        '10. Адреса доменов которые нужно исключить из обработки'=> @$del_urls ? $del_urls : NULL
      );
      // Вызываем функцию записи в лог-файл отладки.
      $this->write_log_file($msgDebug);
    }
  }

  // POST-запрос на выполнение основной задачи WEB-серверу.
  public function curl_multi_set_request_post(){
    // В цикле перебираем элементы массива "$urls" и присвоим параметры
    // сесии cURL.
    foreach($this->urls as $key => $url){
<<<<<<< HEAD
//       //   CURLOPT_AUTOREFERER для автоматической установки поля Referer:
//       //   в запросах, перенаправленных заголовком Location;
//       curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
//       //   CURLOPT_POST    для использования обычного HTTP POST.
//       //   Данный метод POST использует обычный application/x-www-form-urlencoded,
//       //   обычно используемый в HTML-формах.
//       curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
//       //   CURLOPT_POSTFIELDS    Все данные, передаваемые в HTTP POST-запросе.
//       //   Этот параметр может быть передан как в качестве url-закодированной
//       //   строки, наподобие 'para1=val1&para2=val2&...', так и в виде массива,
//       //   ключами которого будут имена полей, а значениями - их содержимое.
//       //   Если value является массивом, заголовок Content-Type будет
//       //   установлен в значение multipart/form-data. Файлы можно отправлять
//       //   с использованием CURLFile или CURLStringFile, в этом случае
//       //   value должен быть массивом;
//       curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $this->user . '&_pass=' . $this->password);
//       //   CURLOPT_URL    Загружаемый URL. Данный параметр может быть также
//       //   установлен при инициализации сеанса с помощью curl_init().
//       curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=login');
//       //   CURLOPT_VERBOSE    Для вывода дополнительной информации.
//       //   Записывает вывод в поток STDERR, или файл, указанный в
//       //   параметре CURLOPT_STDERR.
//       curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
//       //   CURLINFO_HEADER_OUT    true для отслеживания строки запроса
//       //   дескриптора.
//       curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
//       //   CURLOPT_HEADER    true для включения заголовков в вывод.
//       curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
//       //   CURLOPT_RETURNTRANSFER для возврата результата передачи в
//       //   качестве строки из curl_exec() вместо прямого вывода в браузер.
//       curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
//       //   CURLOPT_USERAGENT    Содержимое заголовка "User-Agent: ",
//       //   посылаемого в HTTP-запросе.
//       curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
//       //   CURLOPT_FRESH_CONNECT  Для принудительного использования нового
//       //   соединения вместо закешированного.
//       curl_setopt($this->curls[$url], CURLOPT_FRESH_CONNECT, TRUE);
//       //   curl_multi_add_handle   Добавляет обычный cURL-дескриптор к
//       //   набору cURL-дескрипторов:
//       //   Добавляем текущий механизм к числу работающих параллельно.
//       curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
//     }
//   }

//   // POST-запрос на выполнение основной задачи WEB-серверу.
//   public function curl_multi_set_request_post()
//   {
//     // В цикле перебираем элементы массива "$urls" и присвоим параметры
//     // сесии cURL.
//     foreach($this->urls as $key=>$url){
//       /**
//       * explode — Разбивает строку с помощью разделителя.
//       * Описание:
//       *   explode(string $separator, string $string, int $limit=PHP_INT_MAX):array
//       *
//       * Возвращает массив строк, полученных разбиением строки string с
//       * использованием separator в качестве разделителя.
//       * Список параметров:
//       *   @var separator Разделитель.
//       *   @var string    Входная строка.
//       *   @var limit     Если аргумент limit является положительным,
//       *                  возвращаемый массив будет содержать максимум limit
//       *                  элементов, при этом последний элемент будет
//       *   содержать остаток строки string.
//       *   Если параметр limit отрицателен, то будут возвращены все компоненты,
//       *   кроме последних -limit.
//       *   Если limit равен нулю, то он расценивается как 1.
//       */

      // /**
      // * explode — Разбивает строку с помощью разделителя.
      // * Описание:
      // * explode(string $separator, string $string, int $limit=PHP_INT_MAX):array
      // *
      // * Возвращает массив строк, полученных разбиением строки string с
      // * использованием separator в качестве разделителя.
      // * Список параметров:
      // * @var separator Разделитель.
      // * @var string Входная строка.
      // * @var limit  Если аргумент limit является положительным,
      // *     возвращаемый массив будет содержать максимум limit
      // *     элементов, при этом последний элемент будет
      // * содержать остаток строки string.
      // * Если параметр limit отрицателен, то будут возвращены все компоненты,
      // * кроме последних -limit.
      // * Если limit равен нулю, то он расценивается как 1.
      // */
=======
=======
      //   CURLOPT_AUTOREFERER для автоматической установки поля Referer:
      //   в запросах, перенаправленных заголовком Location;
      curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
      //   CURLOPT_POST    для использования обычного HTTP POST.
      //   Данный метод POST использует обычный application/x-www-form-urlencoded,
      //   обычно используемый в HTML-формах.
      curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
      //   CURLOPT_POSTFIELDS    Все данные, передаваемые в HTTP POST-запросе.
      //   Этот параметр может быть передан как в качестве url-закодированной
      //   строки, наподобие 'para1=val1&para2=val2&...', так и в виде массива,
      //   ключами которого будут имена полей, а значениями - их содержимое.
      //   Если value является массивом, заголовок Content-Type будет
      //   установлен в значение multipart/form-data. Файлы можно отправлять
      //   с использованием CURLFile или CURLStringFile, в этом случае
      //   value должен быть массивом;
      curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_task=login&_action=login&_timezone=Europe/Moscow&_url=&_user=' . $this->user . '&_pass=' . $this->password);
      //   CURLOPT_URL    Загружаемый URL. Данный параметр может быть также
      //   установлен при инициализации сеанса с помощью curl_init().
      curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=login');
      //   CURLOPT_VERBOSE    Для вывода дополнительной информации.
      //   Записывает вывод в поток STDERR, или файл, указанный в
      //   параметре CURLOPT_STDERR.
      curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
      //   CURLINFO_HEADER_OUT    true для отслеживания строки запроса
      //   дескриптора.
      curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
      //   CURLOPT_HEADER    true для включения заголовков в вывод.
      curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
      //   CURLOPT_RETURNTRANSFER для возврата результата передачи в
      //   качестве строки из curl_exec() вместо прямого вывода в браузер.
      curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
      //   CURLOPT_USERAGENT    Содержимое заголовка "User-Agent: ",
      //   посылаемого в HTTP-запросе.
      curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
      //   CURLOPT_FRESH_CONNECT  Для принудительного использования нового
      //   соединения вместо закешированного.
      curl_setopt($this->curls[$url], CURLOPT_FRESH_CONNECT, TRUE);
      //   curl_multi_add_handle   Добавляет обычный cURL-дескриптор к
      //   набору cURL-дескрипторов:
      //   Добавляем текущий механизм к числу работающих параллельно.
      curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
    }
  }

  // POST-запрос на выполнение основной задачи WEB-серверу.
  public function curl_multi_set_request_post()
  {
    // В цикле перебираем элементы массива "$urls" и присвоим параметры
    // сесии cURL.
    foreach($this->urls as $key=>$url){
      /**
      * explode — Разбивает строку с помощью разделителя.
      * Описание:
      *   explode(string $separator, string $string, int $limit=PHP_INT_MAX):array
      *
      * Возвращает массив строк, полученных разбиением строки string с
      * использованием separator в качестве разделителя.
      * Список параметров:
      *   @var separator Разделитель.
      *   @var string    Входная строка.
      *   @var limit     Если аргумент limit является положительным,
      *                  возвращаемый массив будет содержать максимум limit
      *                  элементов, при этом последний элемент будет
      *   содержать остаток строки string.
      *   Если параметр limit отрицателен, то будут возвращены все компоненты,
      *   кроме последних -limit.
      *   Если limit равен нулю, то он расценивается как 1.
      */
>>>>>>> 493de78... Перед построением условий отладки
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
      // Разабьём строку на массив а потом подставим в заголовок то что
      // нужно от URL-адреса.
      $host         = explode('/', $url);

      // Создаём заголовок для запроса "POST" с заданными параметрами:
      // Переменной "$post_headers" присвоим заголовки POST-запроса.
      $post_headers = array
      (
        // Принимаемые типы данных.
        'Accept: text/html',
        'Accept-Language: ru-RU, ru; q=0.8, en-US; q=0.5, en; q=0.3',
        // Заголовок Accept-Encoding HTTP запроса указывает кодировку
        // контента, которую может понять клиент.
        'Accept-Encoding: *',
        'Accept-Charset: utf-8, windows-1251; q=0.7, *; q=0.7',
        // Тип передаваемых данных (URL-кодированные данные).
        'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        'Host: ' . $host['2'],
        'Origin: '. $host['0'] . '//' . $host['2'],
        /**
        * Директива Pragma: no-cache используется для протокола http/1.0.
        * На данный момент можно с полным правом считать ее устаревшей
        * конструкцией. Однако, для корректного запрета кэширования стоит
        * все же выставлять и этот заголовок – никогда не знаешь наверняка,
        * какой еще пользовательский агент обратится к серверу и какой протокол
        * он будет использовать.
        */
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
        /**
        * Инструкции не чувствительны к регистру и имеют необязательный
        * аргумент, который может быть указан как в кавычках, так и без них.
        * Несколько инструкций разделяются запятыми.
        * https://developer.mozilla.org/ru/docs/Web/HTTP/Headers/Cache-Control
        * no-cache,
        */
        'Cache-Control: post-check=0, pre-check=0, max-age=0',
        'Cache-Control: no-store, must-revalidate, private',
        /**
        * Заголовок Expires устанавливает время актуальности информации.
        * Указывает на дату истечения срока годности запрашиваемой страницы.
        * Для ресурсов, которые не должны кэшироваться, его нужно выставлять
        * в текущий момент (документ устаревает сразу же после получения),
<<<<<<< HEAD
        * для форсирования кэширования его можно определять на достаточно
=======
        *  для  форсирования кэширования его можно определять на достаточно
>>>>>>> 493de78... Перед построением условий отладки
        * далекую дату в будущем.
        */
        //'Expires: Sun, 02 Jan 2000 00:00:00 GMT',
        //'Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT',
        'Upgrade-Insecure-Requests: 1',
        'X-Requested-With: XMLHttpRequest',
        'X-Roundcube-Request: ' . $this->tokens[$url],
        'X-Compress: null',
      );

<<<<<<< HEAD
      // Отправляем POST-запрос с указанием команды и заголовков:
=======
      // Отправляем POST-запрос с указанием команды:
>>>>>>> 493de78... Перед построением условий отладки
      // Установка URL и других соответствующих параметров.
      curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($this->curls[$url], CURLOPT_POST, TRUE);
      curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
<<<<<<< HEAD
      // CURLOPT_NOBODY Для исключения тела ответа из вывода.
=======
      // CURLOPT_NOBODY    Для исключения тела ответа из вывода.
>>>>>>> 493de78... Перед построением условий отладки
      // Метод запроса устанавливается в HEAD. Смена этого параметра
      // в false не меняет его обратно в GET.
      curl_setopt($this->curls[$url], CURLOPT_NOBODY, TRUE);
      curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
<<<<<<< HEAD
      // CURLOPT_HTTPHEADER Массив устанавливаемых HTTP - заголовков,
=======
      // CURLOPT_HTTPHEADER    Массив устанавливаемых HTTP - заголовков,
>>>>>>> 493de78... Перед построением условий отладки
      // в формате array('Content - type: text / plain', 'Content - length: 100')
      curl_setopt($this->curls[$url], CURLOPT_HTTPHEADER, $post_headers);
      curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
      // Строка POST-запроса для выполнения основной задачи.
      curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=mail&_action=' . $this->global_task);
      curl_setopt($this->curls[$url], CURLOPT_POSTFIELDS, '_remote=1&_unlock=0');
<<<<<<< HEAD
      // CURLOPT_COOKIE Содержимое заголовка "Cookie: ", используемого
      // в HTTP-запросе.
      // Обратите внимание, что несколько cookies разделяются точкой с
      // с последующим пробелом (например, "fruit=apple; colour=red")
=======
      // CURLOPT_COOKIE    Содержимое заголовка "Cookie: ", используемого
      // в HTTP-запросе.
      // Обратите внимание, что несколько cookies разделяются точкой с
      //  с последующим пробелом (например, "fruit=apple; colour=red")
>>>>>>> 493de78... Перед построением условий отладки
      curl_setopt($this->curls[$url], CURLOPT_COOKIE, $this->cookies[$url]);
      curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
      curl_setopt($this->curls[$url], CURLOPT_FRESH_CONNECT, TRUE);
      curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
<<<<<<< HEAD

      // Если включен режим отладки (debugEnabled = TRUE).// Формируем массив для отладки.
      if($this->debugEnabled == TRUE) $urls[$url]=$post_headers;
    }

    // Выполнение парарельных запросов в cURL.
    // POST-запрос на выполнение команды WEB-серверу.
    $this->curl_multi_exec();

    // Если включен режим отладки (debugEnabled = TRUE).
    if($this->debugEnabled == TRUE){
      // Формируем массив с сообщениями отладки.
      $msgDebug = array(
        // Отладочная информация работы приложения Auto multi login:
        '0. debug'=> "Отладочная информация работы приложения Auto multi login:",
        // Заголовки POST-запроса.
        'post_headers'=> $urls
      );
      // Вызываем функцию записи в лог-файл отладки.
      $this->write_log_file($msgDebug);
    }

    // Получаем ответ на POST-запрос.
    $this->curl_multi_getcontent('post');
  }

  // Сбрасываем все установленные опции.
  // Массив "$urls" содержит url которые нужно обработать.
  function curl_reset($urls){
    // Перебираем массив "$urls" и получаем значения элементов.
    foreach($urls as $urls_reset){
      // Сбрасываем все установленные опции.
      curl_reset($this->curls[$urls_reset]);
    }
  }

  // Выполняем запросы cURL.
  function curl_multi_exec(){
<<<<<<< HEAD
  //   }
  // }

  // // Получаем контент от WEB-сервера. Переменная "$getcontent" показывает
  // // из какого раздела массива: "content_h" или "curl_info" мы хотим
  // // получить данные.
  // public function curl_multi_getcontent($getcontent)
  // {
  //   // В цикле перебираем элементы массива "$this->curls"
  //   // получаем содержимое ответа от сервера.
  //   foreach($this->curls as $key=>$value){
  //     /**
  //     * curl_multi_getcontent — Возвращает результат операции, если была
  //     * установлена опция CURLOPT_RETURNTRANSFER.
  //     * Описание:
  //     *   curl_multi_getcontent(CurlHandle $handle):string|null
  //     *   Если для определённого дескриптора была установлена опция
  //     *   CURLOPT_RETURNTRANSFER, то эта функция вернёт содержимое этого
  //     *   cURL-дескриптора в виде строки.
  //     * Список параметров:
  //     *   @var handle Дескриптор cURL, полученный из curl_init().
  //     * Возвращаемые значения:
  //     *   Возвращает содержимое cURL-дескриптора, если была использована
  //     *   опция CURLOPT_RETURNTRANSFER.
  //     */
  //     // Получаем страницу контента от сервера по нашему запросу.
  //     $this->content_h[$getcontent][$key] = curl_multi_getcontent($this->curls[$key]);

  //     /**
  //     * curl_getinfo — возвращает информацию об определённой операции.
  //     * Описание:
  //     *   curl_getinfo(CurlHandle $handle, ?int $option=null):mixed
  //     * Возвращает информацию о последней операции.
  //     *   @var handle Дескриптор cURL, полученный из curl_init().
  //     *   @var option Одна из перечисленных констант.
  //     * Возвращаемые значения:
  //     *   Если параметр option указан, то возвращается его значение.
  //     *   Иначе возвращается ассоциативный массив со следующими элементами
  //     *   (которые соответствуют значениям аргумента option) или false в
  //     *   случае возникновения ошибки:
  //     *   https://www.php.net/manual/ru/function.curl-getinfo.php
  //     */
  //     // Получаем данные отправляемые серверу.
  //     $this->curl_info[$getcontent][$key] = curl_getinfo($value);

  //     // Следующий блок работает если переменная "$getcontent" равно "auth".
  //     if($getcontent == 'auth'){
  //       /**
  //       * preg_match — выполняет проверку на соответствие регулярному выражению.
  //       * Ищет в заданном тексте subject совпадения с шаблоном pattern.
  //       * Описание:
  //       *   preg_match(string $pattern, string $subject, array &$matches=null, int $flags=0, int $offset=0):int|false
  //       * Список параметров:
  //       *   @var pattern Искомый шаблон в виде строки.
  //       *   @var subject Входная строка.
  //       *   @var matches В случае, если указан дополнительный параметр
  //       *                matches, он будет заполнен результатами поиска.
  //       *                Элемент $matches[0] будет содержать часть строки,
  //       *     соответствующую вхождению всего шаблона, $matches[1] - часть
  //       *     строки, соответствующую первой подмаске и так далее.
  //       * @var flags     flags может быть комбинацией следующих флагов:
  //       *                PREG_OFFSET_CAPTURE - В случае, если этот флаг
  //       *                указан, для каждой найденной подстроки будет указана
  //       *    её позиция (в байтах) в исходной строке. Необходимо помнить,что
  //       *    этот флаг меняет формат возвращаемого массива matches в массив,
  //       *    каждый элемент которого содержит массив, содержащий в индексе с
  //       *    номером 0 найденную подстроку, а смещение этой подстроки в
  //       *    параметре subject - в индексе 1.
  //       *                PREG_UNMATCHED_AS_NULL - Если этот флаг передан,
  //       *                несовпадающие подмаски будут представлены значениями
  //       *      null; в противном случае они отображаются в виде пустых строк (string).
  //       * @var offset  Обычно поиск осуществляется слева направо, с начала
  //       *              строки. Можно использовать дополнительный параметр
  //       *              offset для указания альтернативной начальной позиции
  //       *   для поиска (в байтах).
  //       * Замечание:
  //       *   Использование параметра offset не эквивалентно замене
  //       *   сопоставляемой строки выражением substr($subject, $offset) при
  //       *   вызове функции preg_match(), поскольку шаблон pattern может
  //       *   содержать такие условия как ^, $ или (?<=x).
  //       * Возвращаемые значения:
  //       *   preg_match() возвращает 1, если параметр pattern соответствует
  //       *   переданному параметру subject, 0 если нет, или false в случае ошибки.
  //       */
  //       // Получаем токен.
  //       preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $this->content_h[$getcontent][$key], $token);

  //       // Запишем в массив "$tokens" полученные токены.
  //       $this->tokens[$key] = $token['1'];

  //       // Настройки нашего сервера не позволяют использовать
  //       // CURLOPT_COOKIEJAR и CURLOPT_COOKIEFILE.
  //       // Тогда возмём данные Cookie из заголовка ответа сервера используя
  //       // регулярное выражение "preg_match_all" и функцию "implode":
  //       //   preg_match_all(' / Set - Cookie: (.*); / U', $content, $results);
  //       //   $cookies = implode(';', $results[1]);
  //       // и установим Cookie с помощью curl_setopt($this->curls, CURLOPT_COOKIE, $cookies);
  //       /**
  //       * preg_match_all — выполняет глобальный поиск шаблона в строке.
  //       * Ищет в строке subject все совпадения с шаблоном pattern и помещает
  //       * результат в массив matches в порядке, определяемом комбинацией
  //       * флагов flags. После нахождения первого соответствия последующие
  //       * поиски будут осуществляться не с начала строки, а от конца последнего
  //       * найденного вхождения.
  //       * Описание:
  //       *   preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int $offset=0):int|false|null
  //       * Список параметров:
  //       *   @var pattern Искомый шаблон в виде строки.
  //       *   @var subject Входная строка.
  //       *   @var matches Массив совпавших значений, отсортированный в
  //       *                соответствии с параметром flags.
  //       *   @var flags   Может быть комбинацией флагов.
  //       */
  //       preg_match_all('/Set-Cookie: (.*);/U', $this->content_h[$getcontent][$key], $results);

  //       /**
  //       * implode — объединяет элементы массива в строку.
  //       * Объединяет элементы массива с помощью строки glue.
  //       * Замечание:
  //       *   По историческим причинам функции implode() можно передавать
  //       *   аргументы в любом порядке, однако для согласованности с функцией
  //       *   explode(). Не рекомендуется использовать недокументированный
  //       *   порядок аргументов.
  //       * Описание:
  //       *   implode(string $glue, array $pieces):string
  //       *   implode(array $pieces):string
  //       * Список параметров:
  //       *   @var glue   По умолчанию равен пустой строке.
  //       *   @var pieces Массив объединяемых строк.
  //       * Возвращаемые значения:
  //       *   Возвращает строку, содержащую строковое представление всех элементов
  //       *   массива в указанном порядке, со строкой glue между каждым элементом.
  //       */
  //       // Получаем куки с сервера.
  //       $this->cookies[$key] = implode(';', $results[1]);
  //     }

  //     /**
  //     * curl_multi_remove_handle — удаляет cURL дескриптор из набора
  //     * cURL-дескрипторов.
  //     * Удаляет указанный дескриптор handle из указанного набора дескрипторов
  //     * multi_handle. После того, как дескриптор handle удалён, его можно
  //     * снова использовать в функции curl_exec(). Удаление дескриптора
  //     * handle во время использования также остановит текущую передачу,
  //     * идущую на этом дескрипторе.
  //     * Описание:
  //     *   curl_multi_remove_handle(CurlMultiHandle $multi_handle, CurlHandle $handle):int
  //     * Список параметров:
  //     *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
  //     *   @var handle       Дескриптор cURL, полученный из curl_init().
  //     * Возвращаемые значения:
  //     *   В случае успеха возвращает 0 или одну из констант CURLM_XXX,
  //     *   где XXX - код ошибки.
  //     */
  //     // Закрываем все дескрипторы.
  //     curl_multi_remove_handle($this->multiCurl, $this->curls[$key]);
  //   }

  //   // Если включен режим отладки (debugEnabled = TRUE).
  //   if($this->debugEnabled == TRUE){
  //     // Формируем массив с сообщениями отладки.
  //     $msgDebug = array(
  //       // Отладочная информация работы приложения:
  //       'debug'=> "Отладочная информация работы приложения:",
  //       // Получаем контент авторизации.
  //       '1. getcontent'=> $getcontent,
  //       // Получаем куки с сервера.
  //       '2. results'=> $results,
  //     );
  //     // Вызываем функцию записи в лог-файл отладки.
  //     $this->write_log_file($msgDebug);
  //   }
  // }

  // // Выполнение запросов cURL.
  // public function curl_multi_exec()
  // {
  //   //$content = 'post';
  //   //$rcMcURL->curl_multi_getcontent($content);
  //   $this->curl_multi_getcontent('post');
  // }
  
  //   // Сбрасываем все установленные опции.
  // // Массив "$urls" содержит url которые нужно обработать.
  // function curl_reset($urls){
  //   // Сбрасываем все установленные опции.
  //   foreach($urls as $urls_reset){
  //     /**
  //     * curl_reset — сбросить все настройки обработчика сессии libcurl.
  //     * Эта функция переинициализирует все настройки заданного обработчика
  //     * сессии cURL значениями по умолчанию.
  //     * Описание:
  //     * curl_reset(CurlHandle $handle):void
  //     * Список параметров:
  //     * @var handle Дескриптор cURL, полученный из curl_init().
  //     * Возвращаемые значения:
  //     * Эта функция не возвращает значения после выполнения.
  //     */
  //     curl_reset($this->curls[$urls_reset]);
  //   }
  // }

  // // Выполнение запросов cURL.
  // function curl_multi_exec(){
=======
=======
    }
  }

  // Получаем контент от WEB-сервера. Переменная "$getcontent" показывает
  // из какого раздела массива "content_h" или "curl_info" мы хотим
  // получить данные.
  public function curl_multi_getcontent($getcontent)
  {
    // В цикле перебираем элементы массива "$this->curls"
    // получаем содержимое ответа от сервера.
    foreach($this->curls as $key=>$value){
      /**
      * curl_multi_getcontent — Возвращает результат операции, если была
      * установлена опция CURLOPT_RETURNTRANSFER.
      * Описание:
      *   curl_multi_getcontent(CurlHandle $handle):string|null
      *   Если для определённого дескриптора была установлена опция
      *   CURLOPT_RETURNTRANSFER, то эта функция вернёт содержимое этого
      *   cURL-дескриптора в виде строки.
      * Список параметров:
      *   @var handle Дескриптор cURL, полученный из curl_init().
      * Возвращаемые значения:
      *   Возвращает содержимое cURL-дескриптора, если была использована
      *   опция CURLOPT_RETURNTRANSFER.
      */
      // Получаем страницу контента от сервера по нашему запросу.
      $this->content_h[$getcontent][$key] = curl_multi_getcontent($this->curls[$key]);

      /**
      * curl_getinfo — возвращает информацию об определённой операции.
      * Описание:
      *   curl_getinfo(CurlHandle $handle, ?int $option=null):mixed
      * Возвращает информацию о последней операции.
      *   @var handle Дескриптор cURL, полученный из curl_init().
      *   @var option Одна из перечисленных констант.
      * Возвращаемые значения:
      *   Если параметр option указан, то возвращается его значение.
      *   Иначе возвращается ассоциативный массив со следующими элементами
      *   (которые соответствуют значениям аргумента option) или false в
      *   случае возникновения ошибки:
      *   https://www.php.net/manual/ru/function.curl-getinfo.php
      */
      // Получаем данные отправляемые серверу.
      $this->curl_info[$getcontent][$key] = curl_getinfo($value);

      // Следующий блок работает если переменная "$getcontent" равно "auth".
      if($getcontent == 'auth'){
        /**
        * preg_match — выполняет проверку на соответствие регулярному выражению.
        * Ищет в заданном тексте subject совпадения с шаблоном pattern.
        * Описание:
        *   preg_match(string $pattern, string $subject, array &$matches=null, int $flags=0, int $offset=0):int|false
        * Список параметров:
        *   @var pattern Искомый шаблон в виде строки.
        *   @var subject Входная строка.
        *   @var matches В случае, если указан дополнительный параметр
        *                matches, он будет заполнен результатами поиска.
        *                Элемент $matches[0] будет содержать часть строки,
        *     соответствующую вхождению всего шаблона, $matches[1] - часть
        *     строки, соответствующую первой подмаске и так далее.
        * @var flags     flags может быть комбинацией следующих флагов:
        *                PREG_OFFSET_CAPTURE - В случае, если этот флаг
        *                указан, для каждой найденной подстроки будет указана
        *    её позиция (в байтах) в исходной строке. Необходимо помнить,что
        *    этот флаг меняет формат возвращаемого массива matches в массив,
        *    каждый элемент которого содержит массив, содержащий в индексе с
        *    номером 0 найденную подстроку, а смещение этой подстроки в
        *    параметре subject - в индексе 1.
        *                PREG_UNMATCHED_AS_NULL - Если этот флаг передан,
        *                несовпадающие подмаски будут представлены значениями
        *      null; в противном случае они отображаются в виде пустых строк (string).
        * @var offset  Обычно поиск осуществляется слева направо, с начала
        *              строки. Можно использовать дополнительный параметр
        *              offset для указания альтернативной начальной позиции
        *   для поиска (в байтах).
        * Замечание:
        *   Использование параметра offset не эквивалентно замене
        *   сопоставляемой строки выражением substr($subject, $offset) при
        *   вызове функции preg_match(), поскольку шаблон pattern может
        *   содержать такие условия как ^, $ или (?<=x).
        * Возвращаемые значения:
        *   preg_match() возвращает 1, если параметр pattern соответствует
        *   переданному параметру subject, 0 если нет, или false в случае ошибки.
        */
        // Получаем токен.
        preg_match('/^Location:\s\.\/\?_task=mail&_token=([A-Za-z0-9]+)[^\\n]/im', $this->content_h[$getcontent][$key], $token);

        // Запишем в массив "$tokens" полученные токены.
        $this->tokens[$key] = $token['1'];

        // Настройки нашего сервера не позволяют использовать
        // CURLOPT_COOKIEJAR и CURLOPT_COOKIEFILE.
        // Тогда возмём данные Cookie из заголовка ответа сервера используя
        // регулярное выражение "preg_match_all" и функцию "implode":
        //   preg_match_all(' / Set - Cookie: (.*); / U', $content, $results);
        //   $cookies = implode(';', $results[1]);
        // и установим Cookie с помощью curl_setopt($this->curls, CURLOPT_COOKIE, $cookies);
        /**
        * preg_match_all — выполняет глобальный поиск шаблона в строке.
        * Ищет в строке subject все совпадения с шаблоном pattern и помещает
        * результат в массив matches в порядке, определяемом комбинацией
        * флагов flags. После нахождения первого соответствия последующие
        * поиски будут осуществляться не с начала строки, а от конца последнего
        * найденного вхождения.
        * Описание:
        *   preg_match_all(string $pattern, string $subject, array &$matches=null, int $flags=PREG_PATTERN_ORDER, int $offset=0):int|false|null
        * Список параметров:
        *   @var pattern Искомый шаблон в виде строки.
        *   @var subject Входная строка.
        *   @var matches Массив совпавших значений, отсортированный в
        *                соответствии с параметром flags.
        *   @var flags   Может быть комбинацией флагов.
        */
        preg_match_all('/Set-Cookie: (.*);/U', $this->content_h[$getcontent][$key], $results);

        /**
        * implode — объединяет элементы массива в строку.
        * Объединяет элементы массива с помощью строки glue.
        * Замечание:
        *   По историческим причинам функции implode() можно передавать
        *   аргументы в любом порядке, однако для согласованности с функцией
        *   explode(). Не рекомендуется использовать недокументированный
        *   порядок аргументов.
        * Описание:
        *   implode(string $glue, array $pieces):string
        *   implode(array $pieces):string
        * Список параметров:
        *   @var glue   По умолчанию равен пустой строке.
        *   @var pieces Массив объединяемых строк.
        * Возвращаемые значения:
        *   Возвращает строку, содержащую строковое представление всех элементов
        *   массива в указанном порядке, со строкой glue между каждым элементом.
        */
        // Получаем куки с сервера.
        $this->cookies[$key] = implode(';', $results[1]);
      }

      /**
      * curl_multi_remove_handle — удаляет cURL дескриптор из набора
      * cURL-дескрипторов.
      * Удаляет указанный дескриптор handle из указанного набора дескрипторов
      * multi_handle. После того, как дескриптор handle удалён, его можно
      * снова использовать в функции curl_exec(). Удаление дескриптора
      * handle во время использования также остановит текущую передачу,
      * идущую на этом дескрипторе.
      * Описание:
      *   curl_multi_remove_handle(CurlMultiHandle $multi_handle, CurlHandle $handle):int
      * Список параметров:
      *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
      *   @var handle       Дескриптор cURL, полученный из curl_init().
      * Возвращаемые значения:
      *   В случае успеха возвращает 0 или одну из констант CURLM_XXX,
      *   где XXX - код ошибки.
      */
      // Закрываем все дескрипторы.
      curl_multi_remove_handle($this->multiCurl, $this->curls[$key]);
    }
//    if($this->debugEnabled == TRUE){
//      echo 'cookies: ', "\n";
//      var_dump($this->cookies);
//      echo 'tokens: ', "\n";
//      var_dump($this->tokens);
//    }
  }

  // Выполнение запросов cURL.
  public function curl_multi_exec()
  {
>>>>>>> 493de78... Перед построением условий отладки
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
    // Переменная "$running" показывает число работающих процессов.
    // Переменная "$status" показывает отсутствие ошибок.
    // Инициализируем переменные.
    $status = $running= NULL;

    // Запускаем множественный обработчик:
    // curl_mult_exec запишет в переменную "$running" количество еще не
    // завершившихся процессов.
    // Пока они есть - продолжаем выполнять запросы.
    do{
<<<<<<< HEAD
      // Выполняем запросы cURL.
      $status = curl_multi_exec($this->multiCurl, $running);
=======
      /**
      * curl_multi_exec — запускает подсоединения текущего дескриптора cURL.
      * Обрабатывает каждый дескриптор в стеке. Этот метод может быть вызван
      * вне зависимости от необходимости дескриптора читать или записывать данные.
      * Описание:
      *   curl_multi_exec(CurlMultiHandle $multi_handle, int &$still_running):int
      * Список параметров:
      *   @var multi_handle  Мультидескриптор cURL, полученный из curl_multi_init().
      *   @var still_running Ссылка на флаг, указывающий, идут-ли ещё
      *                      какие-либо действия.
      * Возвращаемые значения:
      *   Код cURL, указанный в предопределённых константах cURL.
      * Замечание:
      *   Здесь возвращаются ошибки, относящиеся только ко всему стеку.
      *   Проблемы всё ещё могут произойти на индивидуальных запросах, даже
      *   когда эта функция возвращает CURLM_OK.
      */
      // Выполняем запросы cURL.
      $status = curl_multi_exec($this->multiCurl, $running);
<<<<<<< HEAD
      /**
      * curl_multi_exec — запускает подсоединения текущего дескриптора cURL.
      * Обрабатывает каждый дескриптор в стеке. Этот метод может быть вызван
      * вне зависимости от необходимости дескриптора читать или записывать данные.
      * Описание:
      * curl_multi_exec(CurlMultiHandle $multi_handle, int &$still_running):int
      * Список параметров:
      * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
      * @var still_running Ссылка на флаг, указывающий, идут-ли ещё
      *      какие-либо действия.
      * Возвращаемые значения:
      * Код cURL, указанный в предопределённых константах cURL.
      * Замечание:
      * Здесь возвращаются ошибки, относящиеся только ко всему стеку.
      * Проблемы всё ещё могут произойти на индивидуальных запросах, даже
      * когда эта функция возвращает CURLM_OK.
      */
      // Выполняем запросы cURL.
      $status = curl_multi_exec($this->multiCurl, $running);
      // /**
      // * curl_multi_exec — запускает подсоединения текущего дескриптора cURL.
      // * Обрабатывает каждый дескриптор в стеке. Этот метод может быть вызван
      // * вне зависимости от необходимости дескриптора читать или записывать данные.
      // * Описание:
      // *   curl_multi_exec(CurlMultiHandle $multi_handle, int &$still_running):int
      // * Список параметров:
      // *   @var multi_handle  Мультидескриптор cURL, полученный из curl_multi_init().
      // *   @var still_running Ссылка на флаг, указывающий, идут-ли ещё
      // *                      какие-либо действия.
      // * Возвращаемые значения:
      // *   Код cURL, указанный в предопределённых константах cURL.
      // * Замечание:
      // *   Здесь возвращаются ошибки, относящиеся только ко всему стеку.
      // *   Проблемы всё ещё могут произойти на индивидуальных запросах, даже
      // *   когда эта функция возвращает CURLM_OK.
      // */
      // // Выполняем запросы cURL.
      // $status = curl_multi_exec($this->multiCurl, $running);

      // /**
      // * curl_multi_select — ждёт активности на любом curl_multi соединении.
      // * Блокирует выполнение скрипта, пока какое-либо из соединений
      // * curl_multi не станет активным.
      // * Описание:
      // *   curl_multi_select(CurlMultiHandle $multi_handle, float $timeout=1.0):int
      // * Список параметров:
      // *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
      // *   @var timeout      Время в секундах для ожидания ответа.
      // * Возвращаемые значения:
      // *   В случае успеха возвращает количество дескрипторов, содержащихся в
      // *   наборах дескрипторов:
      // *   возвращает 0, если не было активности ни на одном дескрипторе;
      // *   возвращает -1 в случае неудачи при ошибке выборки
      // *   (из нижележащего системного вызова выборки).
      // */
=======

>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
      /**
      * curl_multi_select — ждёт активности на любом curl_multi соединении.
      * Блокирует выполнение скрипта, пока какое-либо из соединений
      * curl_multi не станет активным.
      * Описание:
<<<<<<< HEAD
      * curl_multi_select(CurlMultiHandle $multi_handle, float $timeout=1.0):int
      * Список параметров:
      * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
      * @var timeout  Время в секундах для ожидания ответа.
      * Возвращаемые значения:
      * В случае успеха возвращает количество дескрипторов, содержащихся в
      * наборах дескрипторов:
      * возвращает 0, если не было активности ни на одном дескрипторе;
      * возвращает -1 в случае неудачи при ошибке выборки
      * (из нижележащего системного вызова выборки).
      */
=======
      *   curl_multi_select(CurlMultiHandle $multi_handle, float $timeout=1.0):int
      * Список параметров:
      *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
      *   @var timeout      Время в секундах для ожидания ответа.
      * Возвращаемые значения:
      *   В случае успеха возвращает количество дескрипторов, содержащихся в
      *   наборах дескрипторов:
      *   возвращает 0, если не было активности ни на одном дескрипторе;
      *   возвращает -1 в случае неудачи при ошибке выборки
      *   (из нижележащего системного вызова выборки).
      */
>>>>>>> 493de78... Перед построением условий отладки
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
      // Ждём окончания активности на любом curl-соединении - usleep(5).
      if(curl_multi_select($this->multiCurl) == - 1){
        usleep(5);
      }
    } while($running && $status == CURLM_OK);
  }

<<<<<<< HEAD
  // GET-запрос на выход. Функции передаём массив "$del_urls" - список url
  // доменов в которых нужно сделать процедуру выхода.
  function curl_multi_set_get_out($del_urls){
    // Сбрасываем все установленные опции:
    // передаём в функцию массив "$del_urls" по которому будем проходить.
    $this->curl_reset($del_urls);

    // В цикле перебираем элементы массива "$del_url" получаем значение
    //  "$url".
    // Подставляем это значение в массив "$this->curls[]" и присвоим
    // параметры сесии cURL.
<<<<<<< HEAD
  // // Сбрасываем все установленные опции.
  // // Массив "$urls" содержит url которые нужно обработать.
  // public function curl_reset($urls)
  // {
  //   // Сбрасываем все установленные опции.
  //   foreach($urls as $urls_reset){
  //     /**
  //     * curl_reset — сбросить все настройки обработчика сессии libcurl.
  //     * Эта функция переинициализирует все настройки заданного обработчика
  //     * сессии cURL значениями по умолчанию.
  //     * Описание:
  //     *   curl_reset(CurlHandle $handle):void
  //     * Список параметров:
  //     *   @var handle Дескриптор cURL, полученный из curl_init().
  //     * Возвращаемые значения:
  //     *   Эта функция не возвращает значения после выполнения.
  //     */
  //     curl_reset($this->curls[$urls_reset]);
  //   }
  // }

  // // GET-запрос на выход. Функции передаём массив "$del_urls" - список url
  // // доменов в которых нужно сделать процедуру выхода.
  // public function curl_multi_set_get_aut($del_urls)
  // {
  //   // В цикле перебираем элементы массива "$del_url" получаем значение "$url".
  //   // Подставляем это значение в массив "$this->curls[]" и присвоим параметры
  //   // сесии cURL.
    
    // В цикле перебираем элементы массива "$del_url" получаем значение "$url".
    // Подставляем это значение в массив "$this->curls[]" и присвоим параметры
    // сесии cURL.
=======
=======
  // Сбрасываем все установленные опции.
  // Массив "$curl_reset" содержит url которые нужно обработать.
  public function curl_reset($curl_reset)
  {
    // Сбрасываем все установленные опции.
    foreach($curl_reset as $reset){
      /**
      * curl_reset — сбросить все настройки обработчика сессии libcurl.
      * Эта функция переинициализирует все настройки заданного обработчика
      * сессии cURL значениями по умолчанию.
      * Описание:
      *   curl_reset(CurlHandle $handle):void
      * Список параметров:
      *   @var handle Дескриптор cURL, полученный из curl_init().
      * Возвращаемые значения:
      *   Эта функция не возвращает значения после выполнения.
      */
      curl_reset($this->curls[$reset]);
    }
  }

  // GET-запрос на выход. Функции передаём массив "$del_urls" - список url
  // доменов в которых нужно сделать процедуру выхода.
  public function curl_multi_set_get_aut($del_urls)
  {
    // В цикле перебираем элементы массива "$del_url" получаем значение "$url".
    // Подставляем это значение в массив "$this->curls[]" и присвоим параметры
    // сесии cURL.
>>>>>>> 493de78... Перед построением условий отладки
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
    foreach($del_urls as $url){
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
<<<<<<< HEAD

    // Выполнение парарельных запросов в cURL.
    $this->curl_multi_exec();

    // Инициализируем переменную-счётчик для уменьшения колличества url
    // в обработке.
    // Переменной "$runing_urls" присвоим колличество URLs в обработке
    // на данный момент.
    $runing_urls = (count($this->urls));

    // В цикле удаляем не нужные нам адреса
    foreach($del_urls as $url){
      // Закрываем все дескрипторы.
      curl_multi_remove_handle($this->multiCurl, $this->curls[$url]);

      // Удаляем элементы массива по их ключам.

      // // Закрываем все дескрипторы.
      // //curl_multi_remove_handle($this->multiCurl, $rc_curls[$url]);
      // curl_multi_remove_handle($this->multiCurl, $this->curls[$url]);

      // // Удаляем элемент массива по ключу.
      // //unset($rc_curls[$url], $rc_tokens[$url], $rc_content_h['auth'][$url], $rc_content_h['post'][$url]);
      unset($this->content_h['auth'][$url],
        $this->content_h['post'][$url],
        $this->cookies[$url],
        $this->curl_info['auth'][$url],
        $this->curl_info['post'][$url],
        $this->curls[$url],
        $this->tokens[$url]);

      // В массиве "urls"ищем ключ элемента по значению этого элемента.
      // И удаляем этот элемент.
      unset($this->urls[array_search($url, $this->urls)]);

      // Уменьшим переменную - счётчик на единицу.
      $runing_urls--;

      // Если включен режим записи в лог-файл (writeLogEnabled = TRUE):
      // запишем сообщение в лог-файл об исключении url из списка и выходе
      // из авторизиции.
      // /**
      // * array_search — Осуществляет поиск данного значения в массиве и
      // * возвращает ключ первого найденного элемента в случае успешного выполнения.
      // *
      // * array_search(mixed $needle, array $haystack, bool $strict=false):int|string|false
      // *
      // * Ищет в haystack значение needle.
      // * Список параметров:
      // * @var needle Искомое значение.
      // *    Замечание:
      // *    Если needle является строкой, сравнение происходит
      // *    с учётом регистра.
      // * @var haystack Массив.
      // * @var strict Если третий параметр strict установлен в true, то
      // *    функция array_search() будет искать идентичные
      // *    элементы в haystack. Это означает, что также будут
      // * проверяться типы needle в haystack, а объекты должны быть одним
      // * и тем же экземпляром.
      // * Возвращаемые значения:
      // * Возвращает ключ для needle, если он был найден в массиве, иначе false.
      // * Если needle присутствует в haystack более одного раза, будет возвращён
      // * первый найденный ключ. Для того, чтобы возвратить ключи для всех
      // * найденных значений, используйте функцию array_keys() с необязательным
      // * параметром search_value.
      // */
      // //unset($rc_urls[array_search($url, $rc_urls)]);
      // unset($this->urls[array_search($url, $this->urls)]);


      // // Уменьшим нашу переменную - счётчик на единицу.
      // $runing_urls--;

      // // В условии проверяем если включен режим отладки
      // // (debugEnabled = TRUE) и указание записи в лог-файл
      // // (writeLogEnabled = TRUE): вызываем функцию записи в лог-файл.
      if($this->writeLogEnabled == TRUE){
        // Сообщение об исключении url из обработки:
        // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
        $url_exception = date("Y.m.d") . " ";
        // Время (17:16:18).
        $url_exception .= date("H:i:s") . " ";
        // Сообщение об окончании обработки.
        // Добавим новое сообщение к текущему сообщению.
        $url_exception .= "RC multi cURL exception and went out URL: $url. Runing URLs: $runing_urls \n";
        // // Добавим новое сообщение к нашему сообщению.
        // $url_exception .= "RC multi cURL exception and went out URL: $url. Runing URLs: $runing_urls \n";
        // // Выводим сообщение.
        // //echo "\n" . "$url_exception";
        // Вызываем функцию записи в лог-файл.
        $this->write_log_file($url_exception);
      }
    }
    // Удалим массив "$del_urls".
    unset($del_urls, $runing_urls);

    // Если длина массива "curls" равна нулю (в массиве нет элементов):
    // закрываем набор cURL-дескрипторов.
    if(count($this->curls) == 0) curl_multi_close($this->multiCurl);
    // //}

    // // Закрываем набор cURL-дескрипторов.
    // //$this->curl_multi_close();
    // // Закрываем набор cURL - дескрипторов.
    // //function curl_multi_close(){
    // /**
    // * curl_multi_close — закрывает набор cURL-дескрипторов.
    // * Описание:
    // * curl_multi_close(CurlMultiHandle $multi_handle):void
    // * Список параметров:
    // * @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
    // */
    // //curl_multi_close($this->multiCurl);
  }

  //  // GET-запрос на выход. Функции передаём массив "$del_urls" - список url
  //  // доменов в которых нужно сделать процедуру выхода.
  //  public function curl_multi_set_get_aut($del_urls)
  //  {
  //    // В цикле перебираем элементы массива "$del_url" получаем значение "$url".
  //    // Подставляем это значение в массив "$this->curls[]" и присвоим параметры
  //    // сесии cURL.
  //    foreach($del_urls as $url){
  //      curl_setopt($this->curls[$url], CURLOPT_AUTOREFERER, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_HTTPGET, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_URL, $url . '?_task=logout&_token=' . $this->tokens[$url]);
  //      curl_setopt($this->curls[$url], CURLOPT_VERBOSE, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_NOBODY, TRUE);
  //      curl_setopt($this->curls[$url], CURLINFO_HEADER_OUT, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_HEADER, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_RETURNTRANSFER, TRUE);
  //      curl_setopt($this->curls[$url], CURLOPT_COOKIE, $this->cookies[$url]);
  //      curl_setopt($this->curls[$url], CURLOPT_USERAGENT, 'curl/7.81.0');
  //      curl_multi_add_handle($this->multiCurl, $this->curls[$url]);
  //    }
  //  }

  //  // Закрываем набор cURL - дескрипторов.
  //  public function curl_multi_close()
  //  {
  //    /**
  //    * curl_multi_close — закрывает набор cURL-дескрипторов.
  //    * Описание:
  //    *   curl_multi_close(CurlMultiHandle $multi_handle):void
  //    * Список параметров:
  //    *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
  //    */
  //    curl_multi_close($this->multiCurl);
  //  }

  // Запись в лог-файл отладочной информации и информации о действиях
  // программы в папку скрипта на жёсткий диск.
  function write_log_file($args){
  // /**
  // * Запись лог-файла в папку скрипта на жёсткий диск.
  // */
  // function write_log_file($args){
  //   // Пишем содержимое (строку) в файл, используя флаг FILE_APPEND flag для
  //   // дописывания содержимого в конец файла и флаг LOCK_EX для предотвращения
  //   // записи данного файла кем-нибудь другим в данное время.
  //   /**
  //   * Функция записи отладочной информации в log-файл.
  //   * file_put_contents — пишет данные в файл
  //   * Функция идентична последовательным успешным вызовам
  //   * функций fopen(), fwrite() и fclose().
  //   * Если filename не существует, файл будет создан. Иначе, существующий файл
  //   * будет перезаписан, за исключением случая, если указан флаг FILE_APPEND.
  //   * Описание:
  //   * file_put_contents(string $filename , mixed $data , int $flags = 0 , resource $context = ?):int
  //   * Список параметров:
  //   * @param filename Путь к записываемому файлу.
  //   * @param data  Записываемые данные. Может быть типа string, array или
  //   *     ресурсом потока. Если data является потоковым ресурсом
  //   *     (stream), оставшийся буфер этого потока будет скопирован
  //   * в указанный файл.
  //   * Это похоже на использование функции stream_copy_to_stream().
  //   * Также вы можете передать одномерный массив в качестве параметра data.
  //   * Это будет эквивалентно вызову file_put_contents($filename, implode('', $array)).
  //   * @param flags Значением параметра flags может быть любая комбинация
  //   *     следующих флагов, соединённых бинарным оператором ИЛИ (|).
  //   *     Доступные флаги:
  //   * FILE_USE_INCLUDE_PATH - Ищет filename в подключаемых директориях.
  //   *  Подробнее смотрите директиву include_path;
  //   * FILE_APPEND - Если файл filename уже существует, данные будут дописаны в
  //   *  конец файла вместо того, чтобы его перезаписать;
  //   * LOCK_EX - Получить эксклюзивную блокировку на файл на время записи.
  //   *  Другими словами, между вызовами fopen() и fwrite() произойдёт вызов
  //   *  функции flock().
  //   *  Это не одно и то же, что вызов fopen() с флагом "x".
  //   */
  // }

  // // Запись в лог-файл отладочной информации и информации о действиях
  // // программы в папку скрипта на жёсткий диск.
  // function write_log_file($args){
    // Определим путь хранения лог-файла.
    $path = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME);
    // Если включен режим отладки (debugEnabled = TRUE).
    if(@$args['0. debug']=="Отладочная информация работы приложения Auto multi login:"){
      $full_path = $path . '/logs/auto_multi_login_debug.log';
    }else{
      $full_path = $path . '/logs/auto_multi_login.log';
    }
    // Пишем содержимое (строку) в файл, используя флаг FILE_APPEND flag
    // для дописывания содержимого в конец файла и флаг LOCK_EX для
    //  предотвращения записи данного файла кем-нибудь другим в данное время.
    file_put_contents(
      $full_path,
      /**
      * Выводит удобочитаемую информацию о переменной.
      * Первый параметр - массив "args" содержит информацию для записи в файл.
      * Второй параметр - true, функция возвращает информацию вместо
=======
  }

  // Закрываем набор cURL - дескрипторов.
  public function curl_multi_close()
  {
    /**
    * curl_multi_close — закрывает набор cURL-дескрипторов.
    * Описание:
    *   curl_multi_close(CurlMultiHandle $multi_handle):void
    * Список параметров:
    *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
    */
    curl_multi_close($this->multiCurl);
  }

  /**
  * Добавим отладочное сообщение в стёк.
  * Список параметров:
  *   @param string Короткое сообщение о действии.
  *   @param string Выходные данные.
  */
  private function addDebug($msgDebug, $data)
  {
    // Если значение свойства "debugEnabled" отсутствует: вернём "FALSE".
    if(!$this->debugEnabled) return FALSE;
    // В массив "debugStack[]" печатаем отладачное сообщение.
    $this->debugStack[] = sprintf(
      "<b>%s:</b><br /><pre>%s</pre>",
      /**
      * htmlspecialchars — преобразует специальные символы в HTML-сущности.
      * В HTML некоторые символы имеют особый смысл и должны быть представлены
      * в виде HTML-сущностей, чтобы сохранить их значение.
      * Эта функция возвращает строку, над которой проведены эти преобразования.
      * Описание:
      *   htmlspecialchars(string $string, int $flags = ENT_COMPAT, string|null $encoding = null, bool $double_encode = true):string
      */
      // Короткое сообщение о действии и выходные данные. Преобразуем
      // специальные символы в HTML - сущности для вывода в браузер.
      $msgDebug, htmlspecialchars($data)
    );
  }

  /**
  * Формируем дамп стека отладки.
  */
  private function dumpDebugStack()
  {
    print "<p>".join("\n", $this->debugStack)."</p>";
  }

  /**
  * Запись лог-файла в папку скрипта на жёсткий диск.
  */
  public function write_log_file($args)
  {
    // Пишем содержимое (строку) в файл, используя флаг FILE_APPEND flag для
    // дописывания содержимого в конец файла и флаг LOCK_EX для предотвращения
    // записи данного файла кем-нибудь другим в данное время.
    /**
    * Функция записи отладочной информации в log-файл.
    * file_put_contents — пишет данные в файл
    * Функция идентична последовательным успешным вызовам
    * функций fopen(), fwrite() и fclose().
    * Если filename не существует, файл будет создан. Иначе, существующий файл
    * будет перезаписан, за исключением случая, если указан флаг FILE_APPEND.
    * Описание:
    *   file_put_contents(string $filename , mixed $data , int $flags = 0 , resource $context = ?):int
    * Список параметров:
    * @param filename Путь к записываемому файлу.
    * @param data     Записываемые данные. Может быть типа string, array или
    *                 ресурсом потока. Если data является потоковым ресурсом
    *                 (stream), оставшийся буфер этого потока будет скопирован
    *   в указанный файл.
    *   Это похоже на использование функции stream_copy_to_stream().
    *   Также вы можете передать одномерный массив в качестве параметра data.
    *   Это будет эквивалентно вызову file_put_contents($filename, implode('', $array)).
    * @param flags    Значением параметра flags может быть любая комбинация
    *                 следующих флагов, соединённых бинарным оператором ИЛИ (|).
    *                 Доступные флаги:
    *   FILE_USE_INCLUDE_PATH - Ищет filename в подключаемых директориях.
    *     Подробнее смотрите директиву include_path;
    *   FILE_APPEND - Если файл filename уже существует, данные будут дописаны в
    *     конец файла вместо того, чтобы его перезаписать;
    *   LOCK_EX - Получить эксклюзивную блокировку на файл на время записи.
    *     Другими словами, между вызовами fopen() и fwrite() произойдёт вызов
    *     функции flock().
    *     Это не одно и то же, что вызов fopen() с флагом "x".
    */
    // Определим путь хранения лог-файла.
    $path = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME);
    file_put_contents(
      $path . '/logs/rc_curl_multi_connector.log',
      /**
      * print_r — выводит удобочитаемую информацию о переменной.
      * Если вы хотите перехватить вывод print_r(), используйте параметр return.
      * Если его значение равно true, то print_r() вернёт информацию вместо
>>>>>>> 493de78... Перед построением условий отладки
      * вывода в браузер.
      */
      print_r($args, true),
      FILE_APPEND | LOCK_EX
    );
  }
<<<<<<< HEAD
  }

//   // Закрываем набор cURL - дескрипторов.
//   public function curl_multi_close()
//   {
//     /**
//     * curl_multi_close — закрывает набор cURL-дескрипторов.
//     * Описание:
//     *   curl_multi_close(CurlMultiHandle $multi_handle):void
//     * Список параметров:
//     *   @var multi_handle Мультидескриптор cURL, полученный из curl_multi_init().
//     */
  //     curl_multi_close($this->multiCurl);
  //   }

  //   /**
  //   * Запись лог-файла в папку скрипта на жёсткий диск.
  //   */
  //   public function write_log_file($args)
  //   {
  //     // Пишем содержимое (строку) в файл, используя флаг FILE_APPEND flag для
  //     // дописывания содержимого в конец файла и флаг LOCK_EX для предотвращения
  //     // записи данного файла кем-нибудь другим в данное время.
  //     /**
  //     * Функция записи отладочной информации в log-файл.
  //     * file_put_contents — пишет данные в файл
  //     * Функция идентична последовательным успешным вызовам
  //     * функций fopen(), fwrite() и fclose().
  //     * Если filename не существует, файл будет создан. Иначе, существующий файл
  //     * будет перезаписан, за исключением случая, если указан флаг FILE_APPEND.
  //     * Описание:
  //     *   file_put_contents(string $filename , mixed $data , int $flags = 0 , resource $context = ?):int
  //     * Список параметров:
  //     * @param filename Путь к записываемому файлу.
  //     * @param data     Записываемые данные. Может быть типа string, array или
  //     *                 ресурсом потока. Если data является потоковым ресурсом
  //     *                 (stream), оставшийся буфер этого потока будет скопирован
  //     *   в указанный файл.
  //     *   Это похоже на использование функции stream_copy_to_stream().
  //     *   Также вы можете передать одномерный массив в качестве параметра data.
  //     *   Это будет эквивалентно вызову file_put_contents($filename, implode('', $array)).
  //     * @param flags    Значением параметра flags может быть любая комбинация
  //     *                 следующих флагов, соединённых бинарным оператором ИЛИ (|).
  //     *                 Доступные флаги:
  //     *   FILE_USE_INCLUDE_PATH - Ищет filename в подключаемых директориях.
  //     *     Подробнее смотрите директиву include_path;
  //     *   FILE_APPEND - Если файл filename уже существует, данные будут дописаны в
  //     *     конец файла вместо того, чтобы его перезаписать;
  //     *   LOCK_EX - Получить эксклюзивную блокировку на файл на время записи.
  //     *     Другими словами, между вызовами fopen() и fwrite() произойдёт вызов
  //     *     функции flock().
  //     *     Это не одно и то же, что вызов fopen() с флагом "x".
  //     */
  //     // Определим путь хранения лог-файла.
  //     $path = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME);
  //     // Если включен режим отладки (debugEnabled = TRUE).
  //     if(@$args['debug']=="Отладочная информация работы приложения:"){
  //       $full_path = $path . '/logs/auto_multi_login_debug.log';
  //     }else{
  //       $full_path = $path . '/logs/auto_multi_login.log';
  //     }
  //     file_put_contents(
  //       //$path . '/logs/rc_curl_multi_connector.log',
  //       $full_path,
  //       /**
  //       * print_r — выводит удобочитаемую информацию о переменной.
  //       * Если вы хотите перехватить вывод print_r(), используйте параметр return.
  //       * Если его значение равно true, то print_r() вернёт информацию вместо
  //       * вывода в браузер.
  //       */
  //       print_r($args, true),
  //       FILE_APPEND | LOCK_EX
  //     );
  //   }

=======
<<<<<<< HEAD
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.

  // Функция записи сообщения о начале работы программы.
  function start(){
  // public function start(){
  //     * вывода в браузер.
  //     */
  //     print_r($args, true),
  //     FILE_APPEND | LOCK_EX
  //   );
  // }

  // // Функция записи сообщения о начале работы программы.
  // public function start(){
    // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
    $msg_start = date("Y.m.d") . " ";
    // Время (17:16:18).
    $msg_start .= date("H:i:s") . " ";
    // Сообщение начала обработки.
    $msg_start .= "RC multi cURL starting \n";
    // Вызываем функцию записи в лог-файл.
    $this->write_log_file($msg_start);
  }

  // Функция записи сообщения о завершении работы программы.
  function stop(){
  public function stop(){
    // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
    $msg_stop = date("Y.m.d") . " ";
    // Время (17:16:18).
    $msg_stop .= date("H:i:s") . " ";
    // Сообщение об окончании обработки.
    $msg_stop .= "RC multi cURL stopping \n";
    // Вызываем функцию записи в лог-файл.
    $this->write_log_file($msg_stop);
    // // Выводим сообщение.
    // //echo "$msg_start" . "\n";
    // // Вызываем функцию записи в лог-файл.
    // $this->write_log_file($msg_start);
  }
}
<<<<<<< HEAD

// /**
// * Добавим отладочное сообщение в стёк.
// * Список параметров:
// * @param string Короткое сообщение о действии.
// * @param string Выходные данные.
// */
// private function addDebug($msgDebug)
// {
// // Если значение свойства "debugEnabled" отсутствует: вернём "FALSE".
// //if(!$this->debugEnabled) return FALSE;
// // В массив "debugStack[]" печатаем отладачное сообщение о действии.
// $this->debugStack[] = $msgDebug;
// var_dump($this->debugStack);
// $this->write_log_file($this->debugStack);
// }

// // /**
// // * Формируем дамп стека отладки.
// // */
// // private function dumpDebugStack()
// // {
// // print "<p>".join("\n", $this->debugStack)."</p>";
// // }
=======
?>
=======
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
}

/**
* Это исключение входа в систему Roundcube будет сгенерировано,
* если две попытки входа не удастся.
*/
class RoundcubeLoginException extends Exception
{
<<<<<<< HEAD
  // public function stop(){
  //   // Сообщение об окончании работы программы.
  //   // В условии проверяем если включен режим отладки (debugEnabled = TRUE) и
  //   // указание записи в лог-файл (writeLogEnabled == TRUE):
  //   // вызываем функцию записи в лог-файл.
  //   // Дата 2001.03.10 17:16:18 (формат MySQL DATETIME).
  //   $msg_stop = date("Y.m.d") . " ";
  //   // Время (17:16:18).
  //   $msg_stop .= date("H:i:s") . " ";
  //   // Сообщение об окончании обработки.
  //   $msg_stop .= "RC multi cURL stopping \n";
  //   // Выводим сообщение.
  //   //echo "\n" . "$msg_stop";
  //   // Вызываем функцию записи в лог-файл.
  //   $this->write_log_file($msg_stop);
  // }
}
?>
=======
}
>>>>>>> 493de78... Перед построением условий отладки
>>>>>>> 72203ad... Окончательный рабочий вариант для отправки на сервер.
