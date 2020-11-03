<?php

namespace App\Library;


class Afriadverts
{
    /**
     * Convert money given in kobo to Naira by dividing the kobo by 100
     * @param $moneyInKobo
     * @return float
     */
    public static function convertMoneyToNaira(int $moneyInKobo) : float {
        // 1 Naira is equal to 100 kobo
        $oneNaira = 100;
        $division = $moneyInKobo/$oneNaira;
        return $result;
    }


    /**
     * Generate a random string, using a cryptographically secure 
     * pseudorandom number generator (random_int)
     * 
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     * 
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters to select from
     * @return string
     */
    public static function randomStrings($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
