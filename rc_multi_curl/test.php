<?php
$data = Array
(
    'http://yandex.ru',
    'http://php.su',
    'http://google.com'
);

$curls = array();
$result = array();
$mh = curl_multi_init();

foreach ($data as $id => $d) {
    $curls[$id] = curl_init();
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    // Если $d это массив (как в случае с пост), то достаем из массива url
    // если это не массив, а уже ссылка - то берем сразу ссылку

    curl_setopt($curls[$id], CURLOPT_URL,            $url);
    curl_setopt($curls[$id], CURLOPT_HEADER,         0);
    curl_setopt($curls[$id], CURLOPT_RETURNTRANSFER, 1);

    // Если у нас есть пост данные, то есть запрос отправляется постом
    // устанавливаем флаги и добавляем сами данные
    if (is_array($d) && !empty($d['post'])) {
        curl_setopt($curls[$id], CURLOPT_POST,       1);
        curl_setopt($curls[$id], CURLOPT_POSTFIELDS, $d['post']);
    }

    // Если указали дополнительные параметры $options то устанавливаем их
    // смотри документацию функции curl_setopt_array
    //if (count($options) > 0) curl_setopt_array($curls[$id], $options);

    curl_multi_add_handle($mh, $curls[$id]);
}
  $running = null;
  do {
  	curl_multi_exec($mh, $running);
  	} while($running > 0);
?>