<?php

namespace App\Entity;

use App\Repository\ShoppingListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShoppingListRepository::class)
 */
class ShoppingList
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
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=WeekMenu::class, inversedBy="shoppingList", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $weekMenu;

    /**
     * @ORM\OneToMany(targetEntity=LineShopping::class, mappedBy="shoppingList", orphanRemoval=true)
     */
    private $lineShoppings;

    public function __construct()
    {
        $this->lineShoppings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWeekMenu(): ?WeekMenu
    {
        return $this->weekMenu;
    }

    public function setWeekMenu(WeekMenu $weekMenu): self
    {
        $this->weekMenu = $weekMenu;

        return $this;
    }

    /**
     * @return Collection|LineShopping[]
     */
    public function getLineShoppings(): Collection
    {
        return $this->lineShoppings;
    }

    public function addLineShopping(LineShopping $lineShopping): self
    {
        if (!$this->lineShoppings->contains($lineShopping)) {
            $this->lineShoppings[] = $lineShopping;
            $lineShopping->setShoppingList($this);
        }

        return $this;
    }

    public function removeLineShopping(LineShopping $lineShopping): self
    {
        if ($this->lineShoppings->removeElement($lineShopping)) {
            // set the owning side to null (unless already changed)
            if ($lineShopping->getShoppingList() === $this) {
                $lineShopping->setShoppingList(null);
            }
        }

        return $this;
    }
}
