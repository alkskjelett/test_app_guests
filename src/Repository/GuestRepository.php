<?php

namespace App\Repository;

use App\Entity\Guest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guest::class);
    }

    public function save(Guest $guest): void
    {
        if ($guest->getId() === null) {
            $this->getEntityManager()->persist($guest);
        }

        $this->getEntityManager()->flush();
    }

    public function delete(Guest $guest): void
    {
        $this->getEntityManager()->remove($guest);
        $this->getEntityManager()->flush();
    }
}