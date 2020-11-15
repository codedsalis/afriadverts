<?php

namespace App\Library;
use App\Library\AfriConfig;


class Afriadverts extends AfriConfig
{
    /**
     * Convert money given in kobo to Naira by dividing the kobo by 100
     * @param int $moneyInKobo
     * @return float
     */
    private function moneyToNaira(int $amountInKobo) : float {
        // 1 Naira is equal to 100 kobo
        $oneNaira = 100;
        $result = $amountInKobo/$oneNaira;
        return $result;
    }


    /**
     * Convert the amount given in Kobo to US Dollars
     * 
     * @param int $amountInKobo
     * @return float
     */
    private function moneyToUsd(int $amountInKobo) : float {
        // Convert money to Naira first
        $toNaira = $this->moneyToNaira($amountInKobo);

        //Convert to USD
        $toUsd = $toNaira/AfriConfig::USD;

        //Now return the result
        return $toUsd;
    }

    /**
     * Convert money given in Kobo to the user's currency
     * 
     * @param int $amountInKobo
     * @param String $currency
     * @return float
     */
    public function getMoney(int $amountInKobo, String $currency) : float {
        // If the user's currency is USD, convert the Kobo to Naira and then to USD
        if($currency == 'USD') {
            // Convert to USD
            $result = $this->moneyToUsd($amountInKobo);
        }
        elseif($currency == 'NGN') {
            // Convert to Naira
            $result = $this->moneyToNaira($amountInKobo);
        }
        return $result;
    }


    /**
     * Display the money along with the appropriate currency symbol
     * 
     * @param int $moneyInKobo
     * @param String $currency
     * @return String
     */
    public function showMoney(int $amountInKobo, String $currency) : String {
        // Create a format for displaying the currency
        switch($currency) {
            case 'NGN':
                $format = numfmt_create( 'en_NG', \NumberFormatter::CURRENCY);
            break;
            case 'USD':
                $format = numfmt_create( 'en_US', \NumberFormatter::CURRENCY);
            break;
            default:
                $format = numfmt_create( 'en_NG', \NumberFormatter::CURRENCY);
            break;
        }

        // Convert the money to the appropriate currency
        $currencyMoney = $this->getMoney($amountInKobo, $currency);

        // Format and return the formatted money
        return numfmt_format_currency($format, $currencyMoney, $currency);
    }


    /**
     * Convert money from Naira and USD to Kobo so it can be stored efficiently in the Database
     * 
     * @param float $convertedMoney
     * @param String $currency
     * @return int
     */
    public static function moneyToKobo(float $convertedMoney, String $currency) : int {
        if($currency == 'NGN') {
            $amountInKobo = $convertedMoney*100;
        }
        elseif($currency == 'USD') {
            $amountInNaira = $convertedMoney*AfriConfig::USD;
            $amountInKobo = $amountInNaira*100;
        }

        return $amountInKobo;
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
    public static function randomStrings(int $length, String $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') : String
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
