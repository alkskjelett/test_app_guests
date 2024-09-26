<?php

namespace App\Service;

use App\Entity\Guest;

readonly class CountryFiller
{
    public function fillCountry(Guest $guest): void
    {
        $phonePrefix = substr($guest->getPhone(), 0, 2);

    }
}