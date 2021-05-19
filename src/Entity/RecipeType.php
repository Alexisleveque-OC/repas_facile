<?php

namespace App\Entity;

use App\Repository\RecipeTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRecipeRepository::class)
 */
class RecipeType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=recipe::class, inversedBy="typeRecipes")
     */
    private $Recipe;

    public function __construct()
    {
        $this->Recipe = new ArrayCollection();
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

    /**
     * @return Collection|recipe[]
     */
    public function getRecipe(): Collection
    {
        return $this->Recipe;
    }

    public function addRecipe(recipe $recipe): self
    {
        if (!$this->Recipe->contains($recipe)) {
            $this->Recipe[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(recipe $recipe): self
    {
        $this->Recipe->removeElement($recipe);

        return $this;
    }
}
