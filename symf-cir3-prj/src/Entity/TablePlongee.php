<?php

namespace App\Entity;

use App\Repository\TablePlongeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TablePlongeeRepository::class)
 */
class TablePlongee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Profondeur::class, mappedBy="correspond")
     */
    private $profondeurs;

    public function __construct()
    {
        $this->profondeurs = new ArrayCollection();
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

    /**
     * @return Collection|Profondeur[]
     */
    public function getProfondeurs(): Collection
    {
        return $this->profondeurs;
    }

    public function addProfondeur(Profondeur $profondeur): self
    {
        if (!$this->profondeurs->contains($profondeur)) {
            $this->profondeurs[] = $profondeur;
            $profondeur->setCorrespond($this);
        }

        return $this;
    }

    public function removeProfondeur(Profondeur $profondeur): self
    {
        if ($this->profondeurs->removeElement($profondeur)) {
            // set the owning side to null (unless already changed)
            if ($profondeur->getCorrespond() === $this) {
                $profondeur->setCorrespond(null);
            }
        }

        return $this;
    }
}
