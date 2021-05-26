<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="creator_id")
     */
    private $recipes;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteRecipe::class, mappedBy="user", orphanRemoval=true)
     */
    private $favoriteRecipes;

    /**
     * @ORM\OneToMany(targetEntity=WeekMenu::class, mappedBy="user", orphanRemoval=true)
     */
    private $weekMenus;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];
    private $salt;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->favoriteRecipes = new ArrayCollection();
        $this->weekMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setCreatorId($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCreatorId() === $this) {
                $recipe->setCreatorId(null);
            }
        }

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
            $favoriteRecipe->setUser($this);
        }

        return $this;
    }

    public function removeFavoriteRecipe(FavoriteRecipe $favoriteRecipe): self
    {
        if ($this->favoriteRecipes->removeElement($favoriteRecipe)) {
            // set the owning side to null (unless already changed)
            if ($favoriteRecipe->getUser() === $this) {
                $favoriteRecipe->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WeekMenu[]
     */
    public function getWeekMenus(): Collection
    {
        return $this->weekMenus;
    }

    public function addWeekMenu(WeekMenu $weekMenu): self
    {
        if (!$this->weekMenus->contains($weekMenu)) {
            $this->weekMenus[] = $weekMenu;
            $weekMenu->setUser($this);
        }

        return $this;
    }

    public function removeWeekMenu(WeekMenu $weekMenu): self
    {
        if ($this->weekMenus->removeElement($weekMenu)) {
            // set the owning side to null (unless already changed)
            if ($weekMenu->getUser() === $this) {
                $weekMenu->setUser(null);
            }
        }

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
