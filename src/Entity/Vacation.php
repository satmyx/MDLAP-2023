<?php

namespace App\Entity;

use App\Repository\VacationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VacationRepository::class)]
class Vacation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThanOrEqual('today')]
    private ?\DateTimeInterface $dateHeureDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan(propertyPath: 'dateHeureDebut')]
    private ?\DateTimeInterface $dateHeureFin = null;

    #[ORM\OneToMany(mappedBy: 'vacation', targetEntity: Atelier::class)]
    private Collection $ateliers;

    public function __construct()
    {
        $this->ateliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->dateHeureFin;
    }

    public function setDateHeureFin(\DateTimeInterface $dateHeureFin): self
    {
        $this->dateHeureFin = $dateHeureFin;

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getAteliers(): Collection
    {
        return $this->ateliers;
    }

    public function addAtelier(Atelier $atelier): self
    {
        if (!$this->ateliers->contains($atelier)) {
            $this->ateliers->add($atelier);
            $atelier->setVacation($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): self
    {
        if ($this->ateliers->removeElement($atelier)) {
            // set the owning side to null (unless already changed)
            if ($atelier->getVacation() === $this) {
                $atelier->setVacation(null);
            }
        }

        return $this;
    }
    
    public function __toString() {
        $debut = $this->dateHeureDebut->format('d-m-Y H:i:s');
        $fin = $this->dateHeureFin->format('d-m-Y H:i:s');
        $result = 'Du ' . $debut . ' au ' . $fin;
        return $result;
    }
}
