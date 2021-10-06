<?php

require __DIR__ . '/../vendor/autoload.php';

use Hxtree\Pseudorandom\ObfuscateCounter;

// WIP started as a feistel Cipher
$counter = new ObfuscateCounter();

$bank = [];
// must be an even amount of digits
$seed =  "00000000";
for($i = 0; $i < 10000; $i++){
    echo var_dump($counter, true) . PHP_EOL;
    $seed = $counter->run($seed);
    if(in_array($seed, $bank)){
        die('repeat found after ' . count($bank));
    }
    $bank[] = $seed;
}

