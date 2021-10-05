<?php

namespace Hxtree\Pseudorandom;

/**
 * Class FisherYatesShuffle
 * @link https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle
 */
class FisherYatesShuffle
{
    function run(string $seed) {
        $array = str_split($seed);
        for($i = 0; $i < sizeof($array); ++$i) {
            $r = rand(0, $i);
            $tmp = $array[$i];
            $array[$i] = $array[$r];
            $array[$r] = $tmp;
        }
        return implode($array);
    }
}
