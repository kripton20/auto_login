<?php
// Пример #1 Пример использования curl_multi_info_read()
$urls = array(
//    "http://www.cnn.com/",
//    "http://www.bbc.co.uk/",
//    "http://www.yahoo.com/"
    'http://cadmail:10002/rc147-1/'
);

$mh = curl_multi_init();

foreach ($urls as $i => $url) {
    $conn[$i] = curl_init($url);
    //curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($mh, $conn[$i]);
}

do {
    $status = curl_multi_exec($mh, $active);
    $ready = curl_multi_select($mh, 10);
    $info   = curl_multi_info_read($mh);
    if ($info != false) {
        echo 'var_dump';
        echo var_dump($info);
    }
} while ($status === CURLM_CALL_MULTI_PERFORM || $active);

foreach ($urls as $i => $url) {
    $res[$i] = curl_multi_getcontent($conn[$i]);
    curl_close($conn[$i]);
}
echo 'curl_multi_info_read';
echo var_dump(curl_multi_info_read($mh));

//var_dump
//array(3)
//{
//    ["msg"]=> int(1) ["result"]=> int(0) ["handle"]=> resource(3) of type (curl)
//} 
//var_dump
//array(3)
//{
//    ["msg"]=> int(1) ["result"]=> int(0) ["handle"]=> resource(4) of type (curl)
//} 
//var_dump
//array(3)
//{
//    ["msg"]=> int(1) ["result"]=> int(0) ["handle"]=> resource(5) of type (curl)
//}
//curl_multi_info_readbool(false)
?>
