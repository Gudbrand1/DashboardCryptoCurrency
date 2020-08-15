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

    // $data = $result['prices'];

    // $data = call_user_func_array('array_merge', $data);

    // $count = count($data);

    // for($i=0;$i<$count;$i+=2){
    //     $data[$i]=json_encode($data[$i]);
    //     $data[$i]= substr($data[$i], 0, -3);
    //     $data[$i] = new DateTime("@$data[$i]");
    //     $dt =date_format($data[$i], 'Y-m-d H:i:s');
    //     $data[$i] = $dt;
    // }

    // $data = array_chunk($data, 2);

    // $data1 = json_encode($data);

    // $data1 = substr($data1, 1);

    // $str2 = mb_substr($data1, 0, -1);


    // Not working with actual date due to formatting and not enough time to do it properly for now
    // var_dump($str2) leave me a string like this  D:\wamp64\www\Crypto\machin.php:34:string '["28-04-2013 00:00:00",135.3],["29-04-2013 00:00:00",141.96],["30-04-2013 00:00:00",135.3],["01-05-2013 00:00:00",117],["02-05-2013 00:00:00",103.43],["03-05-2013 00:00:00",91.01],["04-05-2013 00:00:00",111.25],["05-05-2013 00:00:00",116.79],["06-05-2013 00:00:00",118.33],["07-05-2013 00:00:00",106.4],["08-05-2013 00:00:00",112.64],["09-05-2013 00:00:00",113],["10-05-2013 00:00:00",118.78],["11-05-2013 00:00:00",113.01],["12-05-2013 00:00:00",114.713],["13-05-2013 00:00:00",117.18],["14-05-2013 00:00:00",11'... (length=102254)

    // will need to use a dateformater https://developers.google.com/chart/interactive/docs/reference#dateformatter
    // or something like this https://cloud.google.com/dataprep/docs/html/PARSEDATE-Function_145272352

    $price = $result['prices'];

    $counted = count($price);
    $merged = call_user_func_array('array_merge', $price);
    $chunks = array_chunk($merged, 2);

    $encoded = json_encode($chunks);

    $str = $encoded;

    $str1 = substr($str, 1);

    $str2 = mb_substr($str1, 0, -1);
    //using this for now as it get us a chart. With more time i could have transform a little more $str2(commented above) to get a readable date for google charts and then being able to display data for all other crypto currency as well

}else{
    echo'the CoinGecko Api is down you might want to comeback later';
}
include 'getcurrency.phtml';
?>