<?php

namespace App\Entity;

use App\Repository\NuitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NuitesRepository::class)]
class Nuites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateNuites = null;

    #[ORM\ManyToOne(inversedBy: 'nuites')]
    private ?Chambre $categorie = null;

    #[ORM\OneToMany(mappedBy: 'typenuites', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNuites(): ?\DateTimeInterface
    {
        return $this->dateNuites;
    }

    public function setDateNuites(\DateTimeInterface $dateNuites): self
    {
        $this->dateNuites = $dateNuites;

        return $this;
    }

    public function getCategorie(): ?Chambre
    {
        return $this->categorie;
    }

    public function setCategorie(?Chambre $categorie): self
    {
        $this->categorie = $categorie;

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
            $inscription->setTypenuites($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getTypenuites() === $this) {
                $inscription->setTypenuites(null);
            }
        }

        return $this;
    }
}
