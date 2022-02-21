<?php

namespace App\Entity;

use App\Repository\PhotosVideosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotosVideosRepository::class)
 */
class PhotosVideos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $photosVideos;

    /**
     * @ORM\Column(type="text")
     */
    private $services;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotosVideos(): ?string
    {
        return $this->photosVideos;
    }

    public function setPhotosVideos(?string $photosVideos): self
    {
        $this->photosVideos = $photosVideos;

        return $this;
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
}
