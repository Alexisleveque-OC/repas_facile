<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Service\Product\CreateProductService;
use App\Service\Product\FinderProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function showAll(FinderProductService $finderService): Response
    {
        $types = $finderService->findAllProductType();

        return $this->render('ingredient/product_list.html.twig', [
            'types' => $types,
        ]);
    }

    /**
     * @Route("/ingredient/create", name="product_create")
     * @Route("/ingredient/create/{$new}", name="product_create_new")
     */
    public function create(Request $request, CreateProductService $createProduct, bool $new = null)
    {
        $formProduct = $this->createForm(ProductType::class);
//dd($formProduct);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()){

            $product = $createProduct->create($formProduct->getData());
            if ($new) {
                return $this->redirectToRoute('product_create_new', [
                    $new => true
                ]);
            }
            return $this->render('ingredient/show.html.twig', [
                'product' => $product
            ]);
        }

        return $this->render('ingredient/create.html.twig',[
            "formProduct" => $formProduct->createView()
        ]);
    }
}
