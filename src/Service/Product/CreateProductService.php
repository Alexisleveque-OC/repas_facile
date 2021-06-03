<?php

namespace App\Service\Product;

use App\Entity\Month;
use App\Entity\Product;
use App\Repository\MonthRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateProductService
{
    /**
     * @var EntityManagerInterface
     */
    public $manager;
    /**
     * @var MonthRepository
     */
    public $monthRepository;

    public function __construct(EntityManagerInterface $manager, MonthRepository $monthRepository)
    {
        $this->manager         = $manager;
        $this->monthRepository = $monthRepository;
    }

    public function create(Product $product)
    {
        $monthBegin = $this->transformStringToMonth($product->getMonthBegin());
        $monthEnd   = $this->transformStringToMonth($product->getMonthEnd());
        $months     = $this->getMonths($monthBegin, $monthEnd);

        if ($months) {
            foreach ($months as $month) {
                $product->addMonth($month);
            }
        }

        $this->manager->persist($product);
        $this->manager->flush();

        return $product;
    }

    private function transformStringToMonth(string $monthName = null): ?Month
    {
        if ($monthName) {
            return $this->monthRepository->findOneBy(['name' => $monthName]);
        }

        return null;
    }

    private function getMonths(Month $monthBegin = null, Month $monthEnd = null)
    {
        if (!$monthBegin && !$monthEnd) {
            return null;
        }
        $months = [];

        if ($monthBegin->getNumber() > $monthEnd->getNumber()) {
            for ($i = $monthBegin->getNumber(); $i <= 12; $i++) {
                $month    = $this->monthRepository->findOneBy(['number' => $i]);
                $months[] = $month;
            }
            for ($i = 1; $i <= $monthEnd->getNumber(); $i++) {
                $month    = $this->monthRepository->findOneBy(['number' => $i ]);
                $months[] = $month;
            }
        } elseif ($monthBegin->getNumber() < $monthEnd->getNumber()) {
            for ($i = $monthBegin->getNumber(); $i <= $monthEnd->getNumber(); $i++) {
                $month    = $this->monthRepository->findOneBy(['number' => $i]);
                $months[] = $month;
            }
        } elseif ($monthBegin->getNumber() === null || $monthEnd->getNumber() === null) {
            $months[] = $monthBegin->getNumber() ?? $monthEnd->getNumber();
        } elseif ($monthBegin->getNumber() === $monthEnd->getNumber()) {
            $months[] = $monthBegin;
        }

        return $months;
    }
}