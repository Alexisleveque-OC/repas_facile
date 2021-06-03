<?php

namespace App\Entity;

use App\Repository\MonthRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MonthRepository::class)
 */
class Month
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
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="months")
     */
    private $Product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;


    public function __construct(string $name)
    {
        $this->Product = new ArrayCollection();
        $this->setName($name);
        switch ($name) {
            case 'Janvier':
                $this->setNumber(1);
                break;
            case 'Février':
                $this->setNumber(2);
                break;
            case 'Mars':
                $this->setNumber(3);
                break;
            case 'Avril':
                $this->setNumber(4);
                break;
            case 'Mai':
                $this->setNumber(5);
                break;
            case 'Juin':
                $this->setNumber(6);
                break;
            case 'Juillet':
                $this->setNumber(7);
                break;
            case 'Août':
                $this->setNumber(8);
                break;
            case 'Septembre':
                $this->setNumber(9);
                break;
            case 'Octobre':
                $this->setNumber(10);
                break;
            case 'Novembre':
                $this->setNumber(11);
                break;
            case 'Décembre':
                $this->setNumber(12);
                break;
        }
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
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->Product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->Product->contains($product)) {
            $this->Product[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->Product->removeElement($product);

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

}
