<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
class Guest implements PayloadInterface
{
    public function __construct(
        #[
            ORM\Id,
            ORM\GeneratedValue('AUTO'),
            ORM\Column(type: 'integer', unique: true)
        ]
        private ?int $id = null,
        #[ORM\Column(type: 'string', length: 50)]
        private ?string $firstname = null,
        #[ORM\Column(type: 'string', length: 50)]
        private ?string $surname = null,
        #[ORM\Column(type: 'string', length: 12, unique: true)]
        private ?string $phone = null,
        #[ORM\Column(type: 'string', length: 80, unique: true)]
        private ?string $email = null,
        #[ORM\Column(type: 'string', length: 30, nullable: true)]
        private ?string $country = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
}