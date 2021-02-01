<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $number_order;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="id_order")
     */
    private $id_article;

    public function __construct()
    {
        $this->id_article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOrder(): ?int
    {
        return $this->number_order;
    }

    public function setNumberOrder(int $number_order): self
    {
        $this->number_order = $number_order;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getIdArticle(): Collection
    {
        return $this->id_article;
    }

    public function addIdArticle(Article $idArticle): self
    {
        if (!$this->id_article->contains($idArticle)) {
            $this->id_article[] = $idArticle;
            $idArticle->addIdOrder($this);
        }

        return $this;
    }

    public function removeIdArticle(Article $idArticle): self
    {
        if ($this->id_article->removeElement($idArticle)) {
            $idArticle->removeIdOrder($this);
        }

        return $this;
    }
}
