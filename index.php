<?php
$clid = clid;
$apikey = APIKey;
$class_str = 'express';

$fromLonLat = '76.93361121975246,43.230385838927816';
$toLonLat = '76.95132452808683,43.24996393218453';

$url = 'https://taxi-routeinfo.taxi.yandex.net/taxi_info';

$options = array(
    'clid' => $clid,
    'apikey' => $apikey,
    'rll' => $fromLonLat.'~'.$toLonLat,
    'class_str' => $class_str,
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($options));

$responce = curl_exec($ch);
curl_close($ch);

echo '<pre>';
print_r($responce);
echo '</pre>';
