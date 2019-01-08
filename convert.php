<?php

require "vendor/autoload.php";

$result = "";
$count = $_POST['count'];

if(!$count || !is_numeric($count) || $count > 100000) {
    $result = "Wrong input";
    echo $result;
    return;
}

//connect to convert API
$provider = new \Thelia\CurrencyConverter\Provider\ECBProvider();
$currencyConverter = new \Thelia\CurrencyConverter\CurrencyConverter($provider);

$baseValue = new \Thelia\Math\Number($count);

/*can be next currencies:
                  USD,JPY,BGN,CZK,DKK,GBP,HUF,PHP,
                  PLN,RON,SEK,CHF,ISK,NOK,HRK,THB,
                  RUB,TRY,AUD,BRL,CAD,CNY,HKD,SGD,
                  IDR,ILS,INR,KRW,MXN,MYR,NZD,ZAR
    */
$currecncyFrom = 'USD';
$currecncyTo = 'CNY';

$convertedValue = $currencyConverter
    ->from($currecncyFrom)
    ->to($currecncyTo)
    ->convert($baseValue);

$result = $count . " " . $currecncyFrom . " is " . $convertedValue->getNumber() . " " . $currecncyTo;

echo $result;