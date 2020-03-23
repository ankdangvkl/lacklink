<?php


$date = date('m/d/Y H:i:s', $_SERVER['REQUEST_TIME'] . "\r\n");

$file = 'trackingfile.txt';
$text = "";
$text .= "REQUEST_TIME: " . $date . "\r\n";

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$referrer = $_SERVER['HTTP_REFERER'];
if ($referred == "") {
  $referrer = "This page was accessed directly";
}
$query_str = $_SERVER['QUERY_STRING'];
$rq_method = $_SERVER['REQUEST_METHOD'];
$http_cf_ray = $_SERVER['HTTP_CF_RAY'];
$http_cf_ipcountry = $_SERVER['HTTP_CF_IPCOUNTRY'];

$text .= "REMOTE_ADDR: " . $ip . "\r\n";
$text .= "HTTP_USER_AGENT: " . $browser . "\r\n";
$text .= "HTTP_REFERER: " . $referrer . "\r\n";
$text .= "QUERY_STRING: " . $query_str . "\r\n";
$text .= "REQUEST_METHOD: " . $rq_method . "\r\n";
$text .= "HTTP_CF_RAY: " . $http_cf_ray . "\r\n";
$text .= "HTTP_CF_IPCOUNTRY: " . $http_cf_ipcountry . "\r\n";

$r = $_GET["r"];
$k = $_GET["k"];
if ( strpos($r, 'http://m.facebook.com')!==false  &&   strpos($browser, '[FB')!==false   && strpos($browser, 'density=') == false && $http_cf_ipcountry == 'VN')
{

$strData = file_get_contents("data.json");
$dataArr = json_decode($strData, true);

    $urlDirect = $dataArr[$k];
    echo $urlDirect;

    $text .= "safe [FB and referrer http://m.facebook.com \r\n" . "\r\n";

}
else
{
    //echo "hi u";
    $text .= "not safe \r\n" . "\r\n";
}

$text .= "_______________\r\n" . "\r\n";

//file_put_contents($file, $text, FILE_APPEND);
