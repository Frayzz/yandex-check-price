<?php
class YandexTaxiApiClient {
    private $clid;
    private $apiKey;
    private $classStr;

    public function __construct($clid, $apiKey, $classStr) {
        $this->clid = $clid;
        $this->apiKey = $apiKey;
        $this->classStr = $classStr;
    }

    public function getRouteInfo($fromLonLat, $toLonLat) {
        $url = 'https://taxi-routeinfo.taxi.yandex.net/taxi_info';

        $options = array(
            'clid' => $this->clid,
            'apikey' => $this->apiKey,
            'rll' => $fromLonLat . '~' . $toLonLat,
            'class_str' => $this->classStr,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($options));

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new Exception("Curl request failed: " . curl_error($ch));
        }

        return $response;
    }
}

try {
    $clid = 'your_clid_here';
    $apiKey = 'your_api_key_here';
    $classStr = 'express';

    $fromLonLat = '76.93361121975246,43.230385838927816';
    $toLonLat = '76.95132452808683,43.24996393218453';

    $client = new YandexTaxiApiClient($clid, $apiKey, $classStr);
    $response = $client->getRouteInfo($fromLonLat, $toLonLat);

    // Вернуть результат запроса для дальнейшей обработки
    echo $response;
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>