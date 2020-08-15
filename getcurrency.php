<?php
require_once(dirname(__FILE__) . '/vendor/autoload.php');

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
$client = new CoinGeckoClient();
$test = $client->ping();
if($test['gecko_says']=='(V3) To the Moon!'){
    //The api is working well, we can proceed

    if(!empty($_POST['cryptoCurrency'] && !empty($_POST['currency']))){
        $cryptocurrency = $_POST['cryptoCurrency'];
        $currency = $_POST['currency'];
    }
    else{
        $cryptocurrency = 'bitcoin'; //default case
        $currency = 'usd';
    }

    $result = $client->coins()->getMarketChart(htmlspecialchars($cryptocurrency), $currency, 'max');
    $priceCrypto = $client->simple()->getPrice($cryptocurrency, $currency);
    $ticker = $client->coins()->getTickers($cryptocurrency);

    $data = $result['prices'];

    $data = call_user_func_array('array_merge', $data);

    $count = count($data);

    for($i=0;$i<$count;$i+=2){
        $data[$i]=json_encode($data[$i]);
        $data[$i]= substr($data[$i], 0, -3);
        $data[$i] = new DateTime("@$data[$i]");
        $dt =date_format($data[$i], 'Y-m-d');
        $data[$i] = $dt;
    }

    $data = array_chunk($data, 2);

    $data1 = json_encode($data);

    $data1 = substr($data1, 1);

    $str2 = mb_substr($data1, 0, -1);

    $str2 = "['Date', 'value']," . $str2;


}else{
    echo'the CoinGecko Api is down you might want to comeback later';
}
include 'getcurrency.phtml';
?>