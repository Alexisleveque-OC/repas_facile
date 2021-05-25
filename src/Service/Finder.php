<?php

namespace App\Service;

use App\Repository\MesureTypeRepository;
use App\Repository\MomentRepository;
use App\Repository\MonthRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\RecipeSpecialRepository;
use App\Repository\RecipeTypeRepository;

class Finder
{
    /**
     * @var MonthRepository
     */
    public $monthRepo;
    /**
     * @var MesureTypeRepository
     */
    public $mesureRepo;
    /**
     * @var ProductTypeRepository
     */
    public $productTypeRepo;
    /**
     * @var MomentRepository
     */
    public $momentRepo;
    /**
     * @var RecipeSpecialRepository
     */
    public $recipeSpecialRepo;
    /**
     * @var RecipeTypeRepository
     */
    public $recipeTypeRepo;

    public function __construct(
        MonthRepository $monthRepo,
        MesureTypeRepository $mesureRepo,
        ProductTypeRepository $productTypeRepo,
        MomentRepository $momentRepo,
        RecipeSpecialRepository $recipeSpecialRepo,
        RecipeTypeRepository $recipeTypeRepo
    ) {
        $this->monthRepo         = $monthRepo;
        $this->mesureRepo        = $mesureRepo;
        $this->productTypeRepo   = $productTypeRepo;
        $this->momentRepo        = $momentRepo;
        $this->recipeSpecialRepo = $recipeSpecialRepo;
        $this->recipeTypeRepo    = $recipeTypeRepo;
    }


    public function findMonth()
    {
        return $this->monthRepo->findAll();
    }

    public function findProduct()
    {
        return $productTypes = $this->productTypeRepo->findAll();
    }

    public function findMesureTypes()
    {
        return $mesureTypes = $this->mesureRepo->findAll();
    }

    public function findRecipeTypes()
    {
        return $recipeTypes = $this->recipeTypeRepo->findAll();
    }

    public function findRecipesSpecials()
    {
        return $recipeSpecials = $this->recipeSpecialRepo->findAll();
    }

    public function findMoments()
    {
        return $moments = $this->momentRepo->findAll();
    }
}