<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\Product\CreateProductService;
use App\Service\Product\FinderProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        return $this->render(
            'ingredient/product_list.html.twig',
            [
                'types' => $types,
            ]
        );
    }

    /**
     * @Route ("ingredient/{product_id}", name ="product_show")
     */
    public function show($product_id, FinderProductService $finderProductService)
    {
        $product = $finderProductService->findOneById($product_id);

        return $this->render(
            'ingredient/show.html.twig',
            [
                'product' => $product,
            ]
        );
    }

    /**
     * @Route("/ingredient/create", name="product_create")
     * @Route("/ingredient/create/{$new}", name="product_create_new")
     * @IsGranted("PRODUCT_CREATE")
     */
    public function create(Request $request, CreateProductService $createProduct, bool $new = false)
    {
        $formProduct = $this->createForm(ProductType::class);

        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            $product = $createProduct->create($formProduct->getData());
            $this->addFlash('success', "Votre ingrédient {$product->getTitle()} a bien été créer");
            if ($formProduct->get('createAndAdd')->isClicked()) {
                return $this->render(
                    'ingredient/create.html.twig',
                    [
                        'formProduct' => $formProduct->createView(),
                        'new'      => true,
                        'product' => $product,
                    ]
                );
            }

            return $this->redirectToRoute(
                'product_show',
                [
                    'product_id' => $product->getId(),
                    'new'         => false,
                ]
            );
        }

        return $this->render(
            'ingredient/create.html.twig',
            [
                "formProduct" => $formProduct->createView(),
                'product'     => null,
                'new'          => false,
            ]
        );
    }

}
