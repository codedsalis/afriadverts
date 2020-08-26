<?php

namespace App;


class Afrilib
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
}
