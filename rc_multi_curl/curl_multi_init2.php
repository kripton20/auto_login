<?php

$urls = Array(
    'http://localhost/php7exemple/session/count.php',
    'http://localhost/php7exemple/session/count1.php',
    'http://localhost/php7exemple/session/count2.php'
);

//создаём набор дескрипторов cURL
$mh = curl_multi_init();

// создаём оба ресурса cURL
//$ch0 = curl_init();
//$ch1 = curl_init();
//$ch2 = curl_init();

foreach ($urls as $key=>$url) {
    // Новая сессия
    $ch[$key] = curl_init();
    
    $cookies[$key]= 'cookies_' . $key . '.txt';
    
    curl_setopt($ch[$key], CURLOPT_HTTPGET, true);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key]);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    
    $curl_multi_add_handle[$key] = curl_multi_add_handle($mh, $ch[$key]);
}

//curl_setopt($ch['0'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['0'], CURLOPT_URL, $urls['0']);
//curl_setopt($ch['0'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['0'], CURLOPT_COOKIEJAR, 'cookies0.txt');
//curl_setopt($ch['0'], CURLOPT_COOKIEFILE, 'cookies0.txt');
//
//curl_setopt($ch['1'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['1'], CURLOPT_URL, $urls['1']);
//curl_setopt($ch['1'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['1'], CURLOPT_COOKIEJAR, 'cookies1.txt');
//curl_setopt($ch['1'], CURLOPT_COOKIEFILE, 'cookies1.txt');
//
//curl_setopt($ch['2'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['2'], CURLOPT_URL, $urls['2']);
//curl_setopt($ch['2'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['2'], CURLOPT_COOKIEJAR, 'cookies2.txt');
//curl_setopt($ch['2'], CURLOPT_COOKIEFILE, 'cookies2.txt');

//добавляем два дескриптора
//$curl_multi_add_handle_0 = curl_multi_add_handle($mh, $ch['0']);
//$curl_multi_add_handle_1 = curl_multi_add_handle($mh, $ch['1']);
//$curl_multi_add_handle_2 = curl_multi_add_handle($mh, $ch['2']);

//foreach ($ch as $key=>$value) {
//	$resource_id =$value;
//$curl_multi_add_handle[$key] = curl_multi_add_handle($mh, $resource_id);
//$x++;
//}

$status                  = $active                  = NULL;

//запускаем множественный обработчик
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

// Запросы выполнены, теперь мы можем получить доступ к результатам
//$headers_0 = curl_multi_getcontent($ch['0']);
//$headers_1 = curl_multi_getcontent($ch['1']);
//$headers_2 = curl_multi_getcontent($ch['2']);

foreach ($ch as $key=>$value) {
	$headers1[$key]=curl_multi_getcontent($ch[$key]);
	echo "\r\n" . $headers1[$key] . "\r\n";
	$result=curl_multi_remove_handle($mh, $ch[$key]);
}

//echo "\r\n" . "\r\n" . "headers_0" . "\r\n" . $headers_0 . "\r\n" . "\r\n";
//echo "\r\n" . "\r\n" . "headers_1" . "\r\n" . $headers_1 . "\r\n" . "\r\n";
//echo "\r\n" . "\r\n" . "headers_2" . "\r\n" . $headers_2 . "\r\n" . "\r\n";

//закрываем все дескрипторы
//curl_multi_remove_handle($mh, $ch['0']);
//curl_multi_remove_handle($mh, $ch['1']);
//curl_multi_remove_handle($mh, $ch['2']);

################# второй запрос
foreach ($urls as $key=>$url) {
    // Новая сессия
    //$ch[$key] = curl_init();
    
    //$cookies[$key]= 'cookies_' . $key . '.txt';
    
    curl_setopt($ch[$key], CURLOPT_HTTPGET, true);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key]);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    
    $curl_multi_add_handle[$key] = curl_multi_add_handle($mh, $ch[$key]);
}

//curl_setopt($ch['0'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['0'], CURLOPT_URL, $urls['0']);
//curl_setopt($ch['0'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['0'], CURLOPT_COOKIEJAR, 'cookies0.txt');
//curl_setopt($ch['0'], CURLOPT_COOKIEFILE, 'cookies0.txt');
//
//curl_setopt($ch['1'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['1'], CURLOPT_URL, $urls['1']);
//curl_setopt($ch['1'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['1'], CURLOPT_COOKIEJAR, 'cookies1.txt');
//curl_setopt($ch['1'], CURLOPT_COOKIEFILE, 'cookies1.txt');
//
//curl_setopt($ch['2'], CURLOPT_HTTPGET, true);
//curl_setopt($ch['2'], CURLOPT_URL, $urls['2']);
//curl_setopt($ch['2'], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch['2'], CURLOPT_COOKIEJAR, 'cookies2.txt');
//curl_setopt($ch['2'], CURLOPT_COOKIEFILE, 'cookies2.txt');

//добавляем два дескриптора
//$curl_multi_add_handle_0_0 = curl_multi_add_handle($mh, $ch['0']);
//$curl_multi_add_handle_1_1 = curl_multi_add_handle($mh, $ch['1']);
//$curl_multi_add_handle_2_2 = curl_multi_add_handle($mh, $ch['2']);

$status                    = $active                    = NULL;

//запускаем множественный обработчик
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

foreach ($ch as $key=>$value) {
	$headers2[$key]=curl_multi_getcontent($ch[$key]);
	echo "\r\n" . $headers2[$key] . "\r\n";
	$result=curl_multi_remove_handle($mh, $ch[$key]);
}

// Запросы выполнены, теперь мы можем получить доступ к результатам
//$headers_0_0 = curl_multi_getcontent($ch['0']);
//$headers_1_1 = curl_multi_getcontent($ch['1']);
//$headers_2_2 = curl_multi_getcontent($ch['2']);
//
//echo "\r\n" . "\r\n" . "headers_0_0" . "\r\n" . $headers_0_0 . "\r\n" . "\r\n";
//echo "\r\n" . "\r\n" . "headers_1_1" . "\r\n" . $headers_1_1 . "\r\n" . "\r\n";
//echo "\r\n" . "\r\n" . "headers_2_2" . "\r\n" . $headers_2_2 . "\r\n" . "\r\n";
#################

//закрываем все дескрипторы
//curl_multi_remove_handle($mh, $ch['0']);
//curl_multi_remove_handle($mh, $ch['1']);
//curl_multi_remove_handle($mh, $ch['2']);

curl_multi_close($mh);
?>