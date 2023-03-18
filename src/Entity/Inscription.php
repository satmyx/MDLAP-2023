<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateInscrit = null;

    #[ORM\OneToMany(mappedBy: 'inscription', targetEntity: User::class)]
    private Collection $inscrit;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?Restauration $restaurer = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?Chambre $nuites = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?Nuites $typenuites = null;

    public function __construct()
    {
        $this->inscrit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscrit(): ?\DateTimeInterface
    {
        return $this->dateInscrit;
    }

    public function setDateInscrit(\DateTimeInterface $dateInscrit): self
    {
        $this->dateInscrit = $dateInscrit;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getInscrit(): Collection
    {
        return $this->inscrit;
    }

    public function addInscrit(User $inscrit): self
    {
        if (!$this->inscrit->contains($inscrit)) {
            $this->inscrit->add($inscrit);
            $inscrit->setInscription($this);
        }

        return $this;
    }

    public function removeInscrit(User $inscrit): self
    {
        if ($this->inscrit->removeElement($inscrit)) {
            // set the owning side to null (unless already changed)
            if ($inscrit->getInscription() === $this) {
                $inscrit->setInscription(null);
            }
        }

        return $this;
    }

    public function getRestaurer(): ?Restauration
    {
        return $this->restaurer;
    }

    public function setRestaurer(?Restauration $restaurer): self
    {
        $this->restaurer = $restaurer;

        return $this;
    }

    public function getNuites(): ?Chambre
    {
        return $this->nuites;
    }

    public function setNuites(?Chambre $nuites): self
    {
        $this->nuites = $nuites;

        return $this;
    }

    public function getTypenuites(): ?Nuites
    {
        return $this->typenuites;
    }

    public function setTypenuites(?Nuites $typenuites): self
    {
        $this->typenuites = $typenuites;

        return $this;
    }
}
