<?php

namespace App\Entity;

use UnexpectedValueException;

enum CountryEnum: string
{
    case RU = 'Россия';
    case EN = 'США';
    case UK = 'Великобритания';
    case GE = 'Германия';

    public static function getCountryByPhonePrefix(string $prefix): CountryEnum
    {
        return match($prefix) {
            '+7' => self::RU,
            '+6' => self::EN,
            '+5' => self::UK,
            '+4' => self::GE,
            default => throw new UnexpectedValueException('Prefix of phone number is invalid'),
        };
    }
}
