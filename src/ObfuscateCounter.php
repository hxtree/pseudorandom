<?php

namespace Hxtree\Pseudorandom;

/**
 * Class ObfuscateCounter
 * @package Hxtree\Pseudorandom
 */
class ObfuscateCounter
{
    /**
     * @var string[] xor values
     */
    private $xorDecimal = [
        '0' => '4',
        '1' => '7',
        '2' => '6',
        '3' => '8',
        '4' => '0',
        '5' => '5',
        '6' => '2',
        '7' => '1',
        '8' => '3',
        '9' => '9'
    ];

    /**
     * @var string the value passed into that has already been encrypted
     */
    private $seed;

    /**
     * @var string the decrypted value with leading zeros
     */
    private $decrypted;

    /**
     * @var string the decrypted value that has been incremented
     */
    private $increment;

    /**
     * @var string the returned incremented and encrypted value
     */
    private $encrypted;

    /**
     * @param string $input
     * @return string
     */
    private function xor(string $input) : string
    {
        $output = '';
        for($i = 0; $i < strlen($input); $i++){
            $char = $input[$i];
            $output .= $this->xorDecimal[$char];
        }
        return $output;
    }

    /**
     * Splits a string into a left and a right
     * @param string $input
     * @return array
     */
    private function split(string $input) : array
    {
        $length = strlen($input);
        $midpoint = $length / 2;
        return [
            'left' => substr($input, 0, $midpoint),
            'right' => substr($input, -$midpoint, $length)
        ];
    }

    /**
     * Increments a number while preserving leading zeros
     * @param string $input
     * @return string
     */
    private function increment(string $input) : string
    {
        $length = strlen($input);
        $max = str_repeat('9', $length);
        $number = ltrim($input, '0');
        $number++;
        if($number > $max){
            $number = '0';
        }
        return  str_pad($number, $length, '0', STR_PAD_LEFT);
    }

    /**
     * Process performs both an encryption and decryption
     * @param $seed
     * @return string
     */
    private function process($seed) : string
    {
        if(strlen($seed) % 2){
            throw new Exception('Only works on even numbered digits');
        }
        $parts = $this->split($seed);
        return $this->xor($parts['right']) . $this->xor($parts['left']);
    }

    /**
     * Increment a seeded encrypted value
     * @param string $seed
     * @return string
     */
    public function run(string $seed) : string
    {
        $this->seed = $seed;
        $this->decrypted = $this->process($seed);
        $this->increment = $this->increment($this->decrypted);
        $this->encrypted = $this->process($this->increment);

        return $this->encrypted;
    }

    /**
     * Get debug info
     * @return array
     */
    public function __debugInfo()
    {
        return [
            'seed' => $this->seed,
            'decrypted' => $this->decrypted,
            'increment' => $this->increment,
            'encrypted' => $this->encrypted,
        ];
    }
}
