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
     * @ORM\ManyToMany(targetEntity=RecipeSpecial::class, mappedBy="recipe")
     */
    private $recipeSpecials;

    /**
     * @ORM\ManyToMany(targetEntity=RecipeType::class, mappedBy="Recipe")
     */
    private $recipeTypes;

    /**
     * @ORM\OneToMany(targetEntity=RecipeLine::class, mappedBy="recipe")
     */
    private $recipeLines;

    public function __construct()
    {
        $this->favoriteRecipes = new ArrayCollection();
        $this->recipeSpecials = new ArrayCollection();
        $this->recipeTypes = new ArrayCollection();
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
     * @return Collection|RecipeSpecial[]
     */
    public function getRecipeSpecials(): Collection
    {
        return $this->recipeSpecials;
    }

    public function addRecipeSpecial(RecipeSpecial $recipeSpecial): self
    {
        if (!$this->recipeSpecials->contains($recipeSpecial)) {
            $this->recipeSpecials[] = $recipeSpecial;
            $recipeSpecial->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeSpecial(RecipeSpecial $recipeSpecial): self
    {
        if ($this->recipeSpecials->removeElement($recipeSpecial)) {
            $recipeSpecial->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|RecipeType[]
     */
    public function getRecipeTypes(): Collection
    {
        return $this->recipeTypes;
    }

    public function addRecipeType(RecipeType $recipeType): self
    {
        if (!$this->recipeTypes->contains($recipeType)) {
            $this->recipeTypes[] = $recipeType;
            $recipeType->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeType(RecipeType $recipeType): self
    {
        if ($this->recipeTypes->removeElement($recipeType)) {
            $recipeType->removeRecipe($this);
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
