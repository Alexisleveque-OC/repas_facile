<?php

namespace App\Controller;

use App\Repository\MonthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinderController extends AbstractController
{
    /**
     * @Route("/finder", name="finder")
     */
    public function index(MonthRepository $monthRepository): Response
    {
        $months = $monthRepository->findAll();
//        dump($months);

        return $this->render('finder/index.html.twig', [
            'controller_name' => 'FinderController',
            'months' => $months
        ]);
    }
}
