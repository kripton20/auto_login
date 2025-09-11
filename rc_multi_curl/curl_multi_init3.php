<?php
// Рабочий вариант. Далее начинаем адаптировать под Roundcube.

$urls = Array(
    'http://localhost/php7exemple/session/count.php',
    'http://localhost/php7exemple/session/count1.php',
    'http://localhost/php7exemple/session/count2.php'
);

$mh = curl_multi_init();

foreach ($urls as $key=>$url) {
    $ch[$key] = curl_init();
    $cookies[$key] = 'cookies_' . $key . '.txt';
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key]);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    curl_multi_add_handle($mh, $ch[$key]);
}

$status = $active = NULL;

do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

foreach ($ch as $key=>$value) {
    $headers1[$key] = curl_multi_getcontent($ch[$key]);
    echo "\r\n" . $headers1[$key] . "\r\n";
    curl_multi_remove_handle($mh, $ch[$key]);
}

// Сбрасываем все установленные опции
foreach ($ch as $key=>$value) {
    curl_reset($ch[$key]);
}

################# второй запрос
foreach ($urls as $key=>$url) {
    curl_setopt($ch[$key], CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch[$key], CURLOPT_URL, $urls[$key]);
    curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch[$key], CURLOPT_COOKIEJAR, $cookies[$key]);
    curl_setopt($ch[$key], CURLOPT_COOKIEFILE, $cookies[$key]);
    curl_multi_add_handle($mh, $ch[$key]);
}

$status = $active = NULL;

do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        curl_multi_select($mh);
    }
} while ($active && $status == CURLM_OK);

foreach ($ch as $key=>$value) {
    $headers2[$key] = curl_multi_getcontent($ch[$key]);
    echo "\r\n" . $headers2[$key] . "\r\n";
    curl_multi_remove_handle($mh, $ch[$key]);
}
#################

// Сбрасываем все установленные опции
foreach ($ch as $key=>$value) {
    curl_reset($ch[$key]);
}

curl_multi_close($mh);
?>