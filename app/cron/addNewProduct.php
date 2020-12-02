<?php

    $params = array('item' => 'Cron файл');
    $curl = curl_init();
    curl_setopt_array($curl,array(
        CURLOPT_URL => 'http://site/app/curl/addNewProduct.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($params)
    ));
    $respone = curl_exec($curl);
    curl_close($curl);