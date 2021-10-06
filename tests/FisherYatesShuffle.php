<?php

require __DIR__ . '/../vendor/autoload.php';

use Hxtree\Pseudorandom\FisherYatesShuffle;

$bank = [];
$shuffle = new FisherYatesShuffle();
$string = '0123456789';
for($i = 0; $i < 10000; $i++){
    $string = $shuffle->run($string);
    echo $string . PHP_EOL;
    if(in_array($string, $bank)){
        die('Repeat found after ' . count($bank));
    }
    $bank[] = $string;
}

// Repeat found after 2766 (although collision varies)
