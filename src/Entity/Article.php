<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maintenance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $utilisation_advice;

    /**
     * @ORM\Column(type="integer")
     */
    private $guarantee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\ManyToMany(targetEntity=Color::class, mappedBy="article")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class, inversedBy="articles")
     */
    private $gender;

    public function __construct()
    {
        $this->color = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMaintenance(): ?string
    {
        return $this->maintenance;
    }

    public function setMaintenance(string $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function getUtilisationAdvice(): ?string
    {
        return $this->utilisation_advice;
    }

    public function setUtilisationAdvice(string $utilisation_advice): self
    {
        $this->utilisation_advice = $utilisation_advice;

        return $this;
    }

    public function getGuarantee(): ?int
    {
        return $this->guarantee;
    }

    public function setGuarantee(int $guarantee): self
    {
        $this->guarantee = $guarantee;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection|Color[]
     */
    public function getColor(): Collection
    {
        return $this->color;
    }

    public function addColor(Color $Color): self
    {
        if (!$this->color->contains($Color)) {
            $this->color[] = $Color;
            $Color->addArticle($this);
        }

        return $this;
    }

    public function removeColor(Color $Color): self
    {
        if ($this->color->removeElement($Color)) {
            $Color->removeArticle($this);
        }

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
