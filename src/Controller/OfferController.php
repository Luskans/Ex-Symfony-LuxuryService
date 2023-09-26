<?php

namespace App\Controller;

use App\Entity\Candidacy;
use App\Entity\Candidate;
use App\Entity\Offer;
use App\Entity\User;
use App\Repository\OfferRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/offer/{id}/add', name: 'app_offer_add')]
    public function add(Offer $offer, OfferRepository $offerRepository, EntityManagerInterface $entityManager): Response
    {
        $offers = $offerRepository->findAll();

        // if ($this->getUser()) {
        //     $candidacy = new Candidacy();
        //     $this->getUser()->getCandidate()->addCandidacy($candidacy);
        //     $offer->addCandidacy($candidacy);
        //     $candidacy->setCandidate($this->getUser()->getCandidate());
        //     $candidacy->setOffer($offer);
        //     $candidacy->setCreatedAt(new DateTimeImmutable());

        //     $entityManager->flush();

        //     return $this->render('offer/show.html.twig', [
        //         'offer' => $offer,
        //         'offers' => $offers
        //     ]);

        // } else {
        //     return $this->redirectToRoute('app_login');
        // }

        // return $this->render('offer/show.html.twig', [
        //     'offer' => $offer,
        //     'offers' => $offers
        // ]);

        if ($this->getUser()) {

            if ($this->getUser()->getCandidate()) {
                $candidacies = $this->getUser()->getCandidate()->getCandidacies();
                $candidacyExist = false;

                foreach ($candidacies as $candidacy) {

                    if ($candidacy->getOffer()->getId() === $offer->getId()) {
                        $candidacyExist = true;
                        break;
                    }
                }

                if ($candidacyExist) {
                    dd("salut");

                } else {
                    $newCandidacy = new Candidacy();
                    $this->getUser()->getCandidate()->addCandidacy($newCandidacy);
                    $offer->addCandidacy($newCandidacy);
                    $newCandidacy->setCandidate($this->getUser()->getCandidate());
                    $newCandidacy->setOffer($offer);
                    $newCandidacy->setCreatedAt(new DateTimeImmutable());

                    $entityManager->flush();

                    return $this->render('offer/show.html.twig', [
                        'offer' => $offer,
                        'offers' => $offers
                    ]);
                }

            } else {
                dd("profil candidat non complet");
            }

        } else {
            return $this->redirectToRoute('app_login');
        }
    }
}
