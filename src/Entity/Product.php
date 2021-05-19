<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity=Month::class, mappedBy="Product")
     */
    private $months;

    /**
     * @ORM\OneToMany(targetEntity=RecipeLine::class, mappedBy="product")
     */
    private $recipeLines;

    /**
     * @ORM\ManyToOne(targetEntity=MesureType::class, inversedBy="Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mesureType;

    /**
     * @ORM\ManyToOne(targetEntity=ProductType::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function __construct()
    {
        $this->productTypes = new ArrayCollection();
        $this->months = new ArrayCollection();
        $this->recipeLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ProductType[]
     */
    public function getProductTypes(): Collection
    {
        return $this->productTypes;
    }

    /**
     * @return Collection|Month[]
     */
    public function getMonths(): Collection
    {
        return $this->months;
    }

    public function addMonth(Month $month): self
    {
        if (!$this->months->contains($month)) {
            $this->months[] = $month;
            $month->addProduct($this);
        }

        return $this;
    }

    public function removeMonth(Month $month): self
    {
        if ($this->months->removeElement($month)) {
            $month->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|RecipeLine[]
     */
    public function getRecipeLines(): Collection
    {
        return $this->recipeLines;
    }

    public function addRecipeLine(RecipeLine $recipeLine): self
    {
        if (!$this->recipeLines->contains($recipeLine)) {
            $this->recipeLines[] = $recipeLine;
            $recipeLine->setProduct($this);
        }

        return $this;
    }

    public function removeRecipeLine(RecipeLine $recipeLine): self
    {
        if ($this->recipeLines->removeElement($recipeLine)) {
            // set the owning side to null (unless already changed)
            if ($recipeLine->getProduct() === $this) {
                $recipeLine->setProduct(null);
            }
        }

        return $this;
    }

    public function getMesureType(): ?MesureType
    {
        return $this->mesureType;
    }

    public function setMesureType(?MesureType $mesureType): self
    {
        $this->mesureType = $mesureType;

        return $this;
    }

    public function getType(): ?ProductType
    {
        return $this->type;
    }

    public function setType(?ProductType $type): self
    {
        $this->type = $type;

        return $this;
    }
}