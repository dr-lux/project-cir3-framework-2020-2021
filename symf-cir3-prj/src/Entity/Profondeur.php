<?php

namespace App\Entity;

use App\Repository\ProfondeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfondeurRepository::class)
 */
class Profondeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $profondeur;

    /**
     * @ORM\OneToMany(targetEntity=Temps::class, mappedBy="est_a")
     */
    private $temps;

    /**
     * @ORM\ManyToOne(targetEntity=TablePlongee::class, inversedBy="profondeurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $correspond;

    public function __construct()
    {
        $this->temps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfondeur(): ?int
    {
        return $this->profondeur;
    }

    public function setProfondeur(int $profondeur): self
    {
        $this->profondeur = $profondeur;

        return $this;
    }

    /**
     * @return Collection|Temps[]
     */
    public function getTemps(): Collection
    {
        return $this->temps;
    }

    public function addTemp(Temps $temp): self
    {
        if (!$this->temps->contains($temp)) {
            $this->temps[] = $temp;
            $temp->setEstA($this);
        }

        return $this;
    }

    public function removeTemp(Temps $temp): self
    {
        if ($this->temps->removeElement($temp)) {
            // set the owning side to null (unless already changed)
            if ($temp->getEstA() === $this) {
                $temp->setEstA(null);
            }
        }

        return $this;
    }

    public function getCorrespond(): ?TablePlongee
    {
        return $this->correspond;
    }

    public function setCorrespond(?TablePlongee $correspond): self
    {
        $this->correspond = $correspond;

        return $this;
    }
}
