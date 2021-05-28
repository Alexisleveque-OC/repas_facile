<?php

namespace App\Service\Product;

use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;

class FinderProductService
{

    /**
     * @var ProductRepository
     */
    public $productRepository;
    /**
     * @var ProductTypeRepository
     */
    public $productTypeRepository;

    public function __construct(ProductRepository $productRepository, ProductTypeRepository $productTypeRepository)
    {
        $this->productRepository = $productRepository;
        $this->productTypeRepository = $productTypeRepository;
    }

    public function findAllProduct()
    {
        return $this->productRepository->findAllProduct();
    }

    public function findAllProductType()
    {
        return $this->productTypeRepository->findAll();
    }
}