<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Chambre::class)]
    private Collection $typeChambre;

    public function __construct()
    {
        $this->typeChambre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getTypeChambre(): Collection
    {
        return $this->typeChambre;
    }

    public function addTypeChambre(Chambre $typeChambre): self
    {
        if (!$this->typeChambre->contains($typeChambre)) {
            $this->typeChambre->add($typeChambre);
            $typeChambre->setHotel($this);
        }

        return $this;
    }

    public function removeTypeChambre(Chambre $typeChambre): self
    {
        if ($this->typeChambre->removeElement($typeChambre)) {
            // set the owning side to null (unless already changed)
            if ($typeChambre->getHotel() === $this) {
                $typeChambre->setHotel(null);
            }
        }

        return $this;
    }
}
