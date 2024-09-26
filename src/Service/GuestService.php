<?php

namespace App\Service;

use App\Entity\CountryEnum;
use App\Entity\Guest;
use App\Repository\GuestRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class GuestService
{
    public function __construct(
        private GuestRepository $guestRepository,
    ) {
    }

    public function findAll(): array
    {
        return $this->guestRepository->findAll();
    }

    public function save(Guest $guest): Guest
    {
        $this->guestRepository->save($guest);
        return $guest;
    }

    public function findGuest(int $id): ?Guest
    {
        return $this->guestRepository->findOneBy(['id' => $id]);
    }

    public function getGuest(int $id): Guest
    {
        $guest = $this->findGuest($id);
        if ($guest === null) {
            throw new NotFoundHttpException(sprintf('Guest with id = %d was not found', $id));
        }

        if (empty($guest->getCountry())) {
            $phonePrefix = substr($guest->getPhone(), 0, 2);
            $guest->setCountry(CountryEnum::getCountryByPhonePrefix($phonePrefix)->value);
        }

        return $guest;
    }

    public function delete(int $id): void
    {
        $guest = $this->getGuest($id);
        $this->guestRepository->delete($guest);
    }

    public function findOneBy(mixed $criteria, ?array $orderBy = null): ?Guest
    {
        return $this->guestRepository->findOneBy($criteria, $orderBy);
    }
}