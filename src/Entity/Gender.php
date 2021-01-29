<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenderRepository::class)
 */
class Gender
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $femme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Homme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFemme(): ?string
    {
        return $this->femme;
    }

    public function setFemme(string $femme): self
    {
        $this->femme = $femme;

        return $this;
    }

    public function getHomme(): ?string
    {
        return $this->Homme;
    }

    public function setHomme(string $Homme): self
    {
        $this->Homme = $Homme;

        return $this;
    }
}
