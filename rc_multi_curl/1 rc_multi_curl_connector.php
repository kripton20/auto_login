<?php
// Логин и пароль для  доступа на почтовый аккаунт.
$user     = 'ocik@niiemp.local';
$password = 'ocik1905niiemp';
//$user = 'l51@niiemp.local';
//$password = 'l51v6249niiemp';

// Массив содержит WEB - адреса хостов которые будем обрабатывать.
$urls     = Array(
    'http://cadmail:10002/rc147-1/',
    'http://cadmail:10002/rc147-2/'
    //    'http://cadmail:10002 / rc147 - 27 / ',
    //    'http://cadmail:10002 / rc147 - 28 / ',
    //    'http://cadmail:10002 / rc147 - 29 / ',
    //    'http://cadmail:10002 / rc147 - 30 / ',
    //    'http://cadmail:10002 / rc147 - 31 / ',
    //    'http://cadmail:10002 / rc147 - 33 / ',
    //    'http://cadmail:10002 / rc147 - 34 / ',
    //    'http://cadmail:10002 / rc147 - 35 / ',
    //    'http://cadmail:10002 / rc147 - 39 / ',
    //    'http://cadmail:10002 / rc147 - 40 / ',
    //    'http://cadmail:10002 / rc147 - 41 / ',
    //    'http://cadmail:10002 / rc147 - 42 / ',
    //    'http://cadmail:10002 / rc147 - 43 / '
);

// Загружаем файл класса "RoundcubeMultiCURL" - инициируем конструкторы класса.
require_once(__DIR__ . '/RoundcubeMultiCURL.Class.php');

// Создаём объект:
// Создаём экземпляр класса "RoundcubeMultiCURL" через переменную "$rcMcURL", и передаём следующие параметры:
// Массив содержит WEB - адреса хостов которые будем обрабатывать.
// 1 параметр: если - TRUE - включаем отладку.
// 2 параметр: если - TRUE - включаем запись отладки в лог - файл.
$rcMcURL = new RoundcubeMultiCURL($urls, $user, $password, TRUE, TRUE);

// Вызываем Первая функция: авторизация.
$rcMcURL->auth();

// Выполнение запросов cURL.
$rcMcURL->curl_multi_exec();

// Получаем контент авторизации.
$rcMcURL->curl_multi_getcontent_auth();

// Сбрасываем все установленные опции.
$rcMcURL->curl_reset();

// Установка параметров на POST-запрос на выполнение команды WEB - серверу.
$rcMcURL->curl_multi_set_rm_post();

// Выполнение запросов cURL.
$rcMcURL->curl_multi_exec();

// Получаем контент POST-запроса.
$rcMcURL->curl_multi_getcontent_rm_post();

// Сбрасываем все установленные опции.
$rcMcURL->curl_reset();

// GET - запрос на выход:
$rcMcURL->get_aut();

// Выполнение запросов cURL.
$rcMcURL->curl_multi_exec();

// Получаем контент выхода.
$rcMcURL->curl_multi_getcontent_aut();

// Сбрасываем все установленные опции.
$rcMcURL->curl_reset();

// Закрываем набор cURL-дескрипторов.
$rcMcURL->curl_multi_close();
$x=1;
?>
