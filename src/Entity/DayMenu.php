<?php

namespace App\Entity;

use App\Repository\DayMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DayMenuRepository::class)
 */
class DayMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=WeekMenu::class, inversedBy="dayMenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $WeekMenu;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class)
     */
    private $Recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Moment::class, inversedBy="DayMenu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $moment;

    public function __construct()
    {
        $this->Recipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWeekMenu(): ?WeekMenu
    {
        return $this->WeekMenu;
    }

    public function setWeekMenu(?WeekMenu $WeekMenu): self
    {
        $this->WeekMenu = $WeekMenu;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipe(): Collection
    {
        return $this->Recipe;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->Recipe->contains($recipe)) {
            $this->Recipe[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        $this->Recipe->removeElement($recipe);

        return $this;
    }

    public function getMoment(): ?Moment
    {
        return $this->moment;
    }

    public function setMoment(?Moment $moment): self
    {
        $this->moment = $moment;

        return $this;
    }
}
