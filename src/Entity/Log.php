<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NumLicencie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHConnexion = null;

    #[ORM\Column(length: 255)]
    private ?string $ip = null;

    #[ORM\Column]
    private ?bool $etatConnexion = null;

    #[ORM\Column(length: 255)]
    private ?string $Pays = null;

    #[ORM\Column(length: 255)]
    private ?string $Navigateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLicencie(): ?string
    {
        return $this->NumLicencie;
    }

    public function setNumLicencie(string $NumLicencie): self
    {
        $this->NumLicencie = $NumLicencie;

        return $this;
    }

    public function getDateHConnexion(): ?\DateTimeInterface
    {
        return $this->dateHConnexion;
    }

    public function setDateHConnexion(\DateTimeInterface $dateHConnexion): self
    {
        $this->dateHConnexion = $dateHConnexion;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function isEtatConnexion(): ?bool
    {
        return $this->etatConnexion;
    }

    public function setEtatConnexion(bool $etatConnexion): self
    {
        $this->etatConnexion = $etatConnexion;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getNavigateur(): ?string
    {
        return $this->Navigateur;
    }

    public function setNavigateur(string $Navigateur): self
    {
        $this->Navigateur = $Navigateur;

        return $this;
    }
}
