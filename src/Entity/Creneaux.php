<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreneauxRepository::class)
 */
class Creneaux
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="Creneaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creneaux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreneaux(): ?services
    {
        return $this->creneaux;
    }

    public function setCreneaux(?services $creneaux): self
    {
        $this->creneaux = $creneaux;

        return $this;
    }
}
