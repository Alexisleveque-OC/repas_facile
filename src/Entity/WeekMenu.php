<?php

namespace App\Entity;

use App\Repository\WeekMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeekMenuRepository::class)
 */
class WeekMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="weekMenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=DayMenu::class, mappedBy="WeekMenu", orphanRemoval=true)
     */
    private $dayMenus;

    /**
     * @ORM\OneToOne(targetEntity=ShoppingList::class, mappedBy="weekMenu", cascade={"persist", "remove"})
     */
    private $shoppingList;

    public function __construct()
    {
        $this->dayMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->StartAt;
    }

    public function setStartAt(\DateTimeInterface $StartAt): self
    {
        $this->StartAt = $StartAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->EndAt;
    }

    public function setEndAt(\DateTimeInterface $EndAt): self
    {
        $this->EndAt = $EndAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|DayMenu[]
     */
    public function getDayMenus(): Collection
    {
        return $this->dayMenus;
    }

    public function addDayMenu(DayMenu $dayMenu): self
    {
        if (!$this->dayMenus->contains($dayMenu)) {
            $this->dayMenus[] = $dayMenu;
            $dayMenu->setWeekMenu($this);
        }

        return $this;
    }

    public function removeDayMenu(DayMenu $dayMenu): self
    {
        if ($this->dayMenus->removeElement($dayMenu)) {
            // set the owning side to null (unless already changed)
            if ($dayMenu->getWeekMenu() === $this) {
                $dayMenu->setWeekMenu(null);
            }
        }

        return $this;
    }

    public function getShoppingList(): ?ShoppingList
    {
        return $this->shoppingList;
    }

    public function setShoppingList(ShoppingList $shoppingList): self
    {
        // set the owning side of the relation if necessary
        if ($shoppingList->getWeekMenu() !== $this) {
            $shoppingList->setWeekMenu($this);
        }

        $this->shoppingList = $shoppingList;

        return $this;
    }
}
