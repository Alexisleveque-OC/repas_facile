<?php

namespace App\Entity;

use App\Repository\MomentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MomentRepository::class)
 */
class Moment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=DayMenu::class, mappedBy="moment")
     */
    private $DayMenu;

    public function __construct()
    {
        $this->DayMenu = new ArrayCollection();
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
     * @return Collection|DayMenu[]
     */
    public function getDayMenu(): Collection
    {
        return $this->DayMenu;
    }

    public function addDayMenu(DayMenu $dayMenu): self
    {
        if (!$this->DayMenu->contains($dayMenu)) {
            $this->DayMenu[] = $dayMenu;
            $dayMenu->setMoment($this);
        }

        return $this;
    }

    public function removeDayMenu(DayMenu $dayMenu): self
    {
        if ($this->DayMenu->removeElement($dayMenu)) {
            // set the owning side to null (unless already changed)
            if ($dayMenu->getMoment() === $this) {
                $dayMenu->setMoment(null);
            }
        }

        return $this;
    }
}
