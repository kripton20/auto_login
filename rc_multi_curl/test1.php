<?php
$urls = array('www.example.com', 'www.php.net');
$mh = curl_multi_init();
//$chs = array();

    foreach ( $urls as $url ) {
        //$chs[] = ( $ch = curl_init() );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_multi_add_handle( $mh, $ch );
    }
    $prev_running = $running = null;
    do {
        curl_multi_exec($mh, $running);
        if ( $running != $prev_running ) {
            // получаю информацию о текущих соединениях
            $info = curl_multi_info_read( $mh );
            if ( is_array( $info ) && ( $ch = $info['handle'] ) ) {
                // получаю содержимое загруженной страницы
                $content = curl_multi_getcontent( $ch );
                // тут какая-то обработка текста страницы
                // пока пусть будет как и в оригинале - вывод в STDOUT
                echo $content;
            }
            // обновляю кешируемое число текущих активных соединений
            $prev_running = $running;
        }
    } while ( $running > 0 );

    foreach ( $chs as $ch ) {
        curl_multi_remove_handle( $mh, $ch );
        curl_close( $ch );
    }
    curl_multi_close($mh);
?>