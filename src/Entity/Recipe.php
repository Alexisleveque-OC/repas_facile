<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     */
    private $creator;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteRecipe::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $favoriteRecipes;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialRecipe::class, mappedBy="recipe")
     */
    private $specialRecipes;

    /**
     * @ORM\ManyToMany(targetEntity=TypeRecipe::class, mappedBy="Recipe")
     */
    private $typeRecipes;

    /**
     * @ORM\OneToMany(targetEntity=RecipeLine::class, mappedBy="recipe")
     */
    private $recipeLines;

    public function __construct()
    {
        $this->favoriteRecipes = new ArrayCollection();
        $this->specialRecipes = new ArrayCollection();
        $this->typeRecipes = new ArrayCollection();
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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection|FavoriteRecipe[]
     */
    public function getFavoriteRecipes(): Collection
    {
        return $this->favoriteRecipes;
    }

    public function addFavoriteRecipe(FavoriteRecipe $favoriteRecipe): self
    {
        if (!$this->favoriteRecipes->contains($favoriteRecipe)) {
            $this->favoriteRecipes[] = $favoriteRecipe;
            $favoriteRecipe->setRecipe($this);
        }

        return $this;
    }

    public function removeFavoriteRecipe(FavoriteRecipe $favoriteRecipe): self
    {
        if ($this->favoriteRecipes->removeElement($favoriteRecipe)) {
            // set the owning side to null (unless already changed)
            if ($favoriteRecipe->getRecipe() === $this) {
                $favoriteRecipe->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SpecialRecipe[]
     */
    public function getSpecialRecipes(): Collection
    {
        return $this->specialRecipes;
    }

    public function addSpecialRecipe(SpecialRecipe $specialRecipe): self
    {
        if (!$this->specialRecipes->contains($specialRecipe)) {
            $this->specialRecipes[] = $specialRecipe;
            $specialRecipe->addRecipe($this);
        }

        return $this;
    }

    public function removeSpecialRecipe(SpecialRecipe $specialRecipe): self
    {
        if ($this->specialRecipes->removeElement($specialRecipe)) {
            $specialRecipe->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|TypeRecipe[]
     */
    public function getTypeRecipes(): Collection
    {
        return $this->typeRecipes;
    }

    public function addTypeRecipe(TypeRecipe $typeRecipe): self
    {
        if (!$this->typeRecipes->contains($typeRecipe)) {
            $this->typeRecipes[] = $typeRecipe;
            $typeRecipe->addRecipe($this);
        }

        return $this;
    }

    public function removeTypeRecipe(TypeRecipe $typeRecipe): self
    {
        if ($this->typeRecipes->removeElement($typeRecipe)) {
            $typeRecipe->removeRecipe($this);
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
            $recipeLine->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeLine(RecipeLine $recipeLine): self
    {
        if ($this->recipeLines->removeElement($recipeLine)) {
            // set the owning side to null (unless already changed)
            if ($recipeLine->getRecipe() === $this) {
                $recipeLine->setRecipe(null);
            }
        }

        return $this;
    }

}
