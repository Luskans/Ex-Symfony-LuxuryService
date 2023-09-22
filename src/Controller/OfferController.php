<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    #[Route('/offer', name: 'app_offer')]
    public function offer(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAll();

        return $this->render('offer/index.html.twig', [
            'offers' => $offers
        ]);
    }

    #[Route('/offer/{id}', name: 'app_offer_show')]
    public function show(Offer $offer, OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAll(); 


        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
            'offers' => $offers
        ]);
    }
}
