<?php

$urls = Array(
    'http://localhost/php7exemple/session/count.php',
    'http://localhost/php7exemple/session/count1.php',
    'http://localhost/php7exemple/session/count2.php'
);

//// создаём оба ресурса cURL
//$ch0 = curl_init();
//$ch1 = curl_init();
//$ch2 = curl_init();

//создаём набор дескрипторов cURL
$mh = curl_multi_init();

// В цикле опираясь на массив "$urls" выполняем все операции.
foreach ($urls as $key=>$url) {
    // Новая сессия
    $ch[$key] = curl_init();

    curl_setopt($ch[$key], CURLOPT_HTTPGET, true);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$url]);
    //curl_setopt($ch[$key], CURLOPT_HEADER, TRUE);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, 'cookies' . $urls[$key]. '.txt');
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, 'cookies' . $urls[$key]. '.txt');
}

//curl_setopt($ch1, CURLOPT_HTTPGET, true);
//curl_setopt($ch1, CURLOPT_URL, $urls['1']);
////curl_setopt($ch1, CURLOPT_HEADER, TRUE);
//curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookies1.txt');
//curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookies1.txt');
//
//curl_setopt($ch2, CURLOPT_HTTPGET, true);
//curl_setopt($ch2, CURLOPT_URL, $urls['2']);
////curl_setopt($ch2, CURLOPT_HEADER, TRUE);
//curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
//curl_setopt($ch2, CURLOPT_COOKIEJAR, 'cookies2.txt');
//curl_setopt($ch2, CURLOPT_COOKIEFILE, 'cookies2.txt');

//добавляем два дескриптора
//curl_multi_add_handle($mh,$ch0);
//curl_multi_add_handle($mh,$ch1);
//curl_multi_add_handle($mh,$ch2);
//foreach ($ch as $key=>$value) {
//    $ch_k = $ch[$key];
//    $curl_multi_add_handle = curl_multi_add_handle($mh, $ch_k);
//    $x++;
//}
$curl_multi_add_handle_0 = curl_multi_add_handle($mh, $ch['0']);
$curl_multi_add_handle_1 = curl_multi_add_handle($mh, $ch['1']);
$curl_multi_add_handle_2 = curl_multi_add_handle($mh, $ch['2']);

//запускаем множественный обработчик
do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

// Запросы выполнены, теперь мы можем получить доступ к результатам
//$headers_0 = curl_multi_getcontent($ch0);
//$headers_1 = curl_multi_getcontent($ch1);
//$headers_2 = curl_multi_getcontent($ch2);
foreach ($ch as $key=>$value) {
    $headers[$key] = curl_multi_getcontent($ch[$value]);
}

//echo "headers_0" . "\r\n" . $headers_0 . "\r\n" . "\r\n";
//echo "headers_1" . "\r\n" . $headers_1 . "\r\n" . "\r\n";
//echo "headers_2" . "\r\n" . $headers_2 . "\r\n" . "\r\n";
foreach ($headers as $key=>$value) {
    echo "content" . $content[$key] . "\r\n" . $content[$value] . "\r\n" . "\r\n";
}

//закрываем все дескрипторы
//curl_multi_remove_handle($mh, $ch0);
//curl_multi_remove_handle($mh, $ch1);
//curl_multi_remove_handle($mh, $ch2);
foreach ($urls as $key=>$value) {
    curl_multi_remove_handle($mh, $ch[$key]);
}

//################# второй запрос
//curl_setopt($ch0, CURLOPT_HTTPGET, true);
//curl_setopt($ch0, CURLOPT_URL, $urls['0']);
////curl_setopt($ch0, CURLOPT_HEADER, TRUE);
//curl_setopt($ch0, CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
////curl_setopt($ch0, CURLOPT_COOKIEJAR, 'cookies0.txt');
//curl_setopt($ch0, CURLOPT_COOKIEFILE, 'cookies0.txt');
//
//curl_setopt($ch1, CURLOPT_HTTPGET, true);
//curl_setopt($ch1, CURLOPT_URL, $urls['1']);
////curl_setopt($ch1, CURLOPT_HEADER, TRUE);
//curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
////curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookies1.txt');
//curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookies1.txt');
//
//curl_setopt($ch2, CURLOPT_HTTPGET, true);
//curl_setopt($ch2, CURLOPT_URL, $urls['2']);
////curl_setopt($ch2, CURLOPT_HEADER, TRUE);
//curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);//Убираем вывод данных в браузер. Пусть функция их возвращает, а не выводит
////curl_setopt($ch2, CURLOPT_COOKIEJAR, 'cookies2.txt');
//curl_setopt($ch2, CURLOPT_COOKIEFILE, 'cookies2.txt');
//
////добавляем два дескриптора
//curl_multi_add_handle($mh,$ch0);
//curl_multi_add_handle($mh,$ch1);
//curl_multi_add_handle($mh,$ch2);
//
////запускаем множественный обработчик
//do {
//    $status = curl_multi_exec($mh, $active);
//    if ($active) {
//        curl_multi_select($mh);
//    }
//} while ($active && $status == CURLM_OK);
//
//// Запросы выполнены, теперь мы можем получить доступ к результатам
//$headers_0_0 = curl_multi_getcontent($ch0);
//$headers_1_0 = curl_multi_getcontent($ch1);
//$headers_2_0 = curl_multi_getcontent($ch2);
//
//echo "headers_0_0" . "\r\n" . $headers_0_0 . "\r\n" . "\r\n";
//echo "headers_1_0" . "\r\n" . $headers_1_0 . "\r\n" . "\r\n";
//echo "headers_2_0" . "\r\n" . $headers_2_0 . "\r\n" . "\r\n";
//#################
//
////закрываем все дескрипторы
//curl_multi_remove_handle($mh, $ch0);
//curl_multi_remove_handle($mh, $ch1);
//curl_multi_remove_handle($mh, $ch2);

curl_multi_close($mh);
?>