<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
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
    private $namecolor;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="color")
     */
    private $article;

    public function __construct()
    {
        $this->article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameColor(): ?string
    {
        return $this->namecolor;
    }

    public function setNameColor(string $namecolor): self
    {
        $this->namecolor = $namecolor;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $Article): self
    {
        if (!$this->article->contains($Article)) {
            $this->article[] = $Article;
        }

        return $this;
    }

    public function removeArticle(Article $Article): self
    {
        $this->article->removeElement($Article);

        return $this;
    }
}
