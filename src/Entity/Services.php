<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Creneaux::class, mappedBy="creneaux")
     */
    private $Creneaux;

    public function __construct()
    {
        $this->Creneaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServices(): ?string
    {
        return $this->services;
    }

    public function setServices(string $services): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return Collection|Creneaux[]
     */
    public function getCreneaux(): Collection
    {
        return $this->Creneaux;
    }

    public function addCreneaux(Creneaux $creneaux): self
    {
        if (!$this->Creneaux->contains($creneaux)) {
            $this->Creneaux[] = $creneaux;
            $creneaux->setCreneaux($this);
        }

        return $this;
    }

    public function removeCreneaux(Creneaux $creneaux): self
    {
        if ($this->Creneaux->removeElement($creneaux)) {
            // set the owning side to null (unless already changed)
            if ($creneaux->getCreneaux() === $this) {
                $creneaux->setCreneaux(null);
            }
        }

        return $this;
    }
}
