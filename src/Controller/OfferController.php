<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    #[Route('/offer', name: 'app_offer')]
    public function offer(): Response
    {
        return $this->render('offer/index.html.twig', [
            'controller_name' => 'OfferController',
        ]);
    }

    #[Route('/offer/show', name: 'app_offer_show')]
    public function index(): Response
    {
        return $this->render('offer/show.html.twig', [
            'controller_name' => 'OfferController',
        ]);
    }
}
