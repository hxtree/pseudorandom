# Pseudorandom number generator

A library collection of pseudorandom number generator (PRNG), also known as a deterministic random bit 
generator (DRBG), used for generating a sequence of numbers whose properties approximate the properties of sequences of 
random numbers.

## FisherYatesShuffle
Although the exact collision point varies based on random, using 10 digits a repeat was encountered after 2766 iterations.
```
<?php

require __DIR__ . '/../vendor/autoload.php';

$bank = [];
$shuffle = new Pseudorandom/FisherYatesShuffle();
$string = '0123456789';
for($i = 0; $i < 10000; $i++){
    $string = $shuffle->run($string);
    echo $string . PHP_EOL;
    if(in_array($string, $bank)){
        die('Repeat found after ' . count($bank));
    }
    $bank[] = $string;
}


```

## Basic Usage
```
git clone https://github.com/hxtree/pseudorandom.git
docker build --target test --tag pseudorandom:latest -f Dockerfile .
docker run -it --mount type=bind,source="$(pwd)"/,target=/application/ pseudorandom:latest php tests/FisherYatesShuffle.php
```