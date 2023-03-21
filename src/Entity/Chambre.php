<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $tarifsNuites = null;

    #[ORM\ManyToOne(inversedBy: 'chambres')]
    private ?Hotel $apartenir = null;

    #[ORM\OneToMany(mappedBy: 'loger', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTarifsNuites(): ?string
    {
        return $this->tarifsNuites;
    }

    public function setTarifsNuites(string $tarifsNuites): self
    {
        $this->tarifsNuites = $tarifsNuites;

        return $this;
    }

    public function getApartenir(): ?Hotel
    {
        return $this->apartenir;
    }

    public function setApartenir(?Hotel $apartenir): self
    {
        $this->apartenir = $apartenir;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setLoger($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getLoger() === $this) {
                $inscription->setLoger(null);
            }
        }

        return $this;
    }
}
