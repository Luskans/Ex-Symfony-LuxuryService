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
        $candidacyError = 0;

        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
            'offers' => $offers,
            'candidacyError' => $candidacyError
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

            if ($this->getUser()->getCandidate()->getPercentCompleted() == 100) {

                if  ($this->getUser()->getCandidate()->isIsAvailable()) {

                    $candidacies = $this->getUser()->getCandidate()->getCandidacies();
                    $candidacyExist = false;
                    $candidacyError = 0;

                    foreach ($candidacies as $candidacy) {

                        if ($candidacy->getOffer()->getId() === $offer->getId()) {
                            $candidacyExist = true;
                            break;
                        }
                    }

                    if ($candidacyExist) {
                        $candidacyError = 1;
                        // dd("offre deja candidatée");
                        return $this->render('offer/show.html.twig', [
                            'offer' => $offer,
                            'offers' => $offers,
                            'candidacyError' => $candidacyError
                        ]);

                    } else {
                        $candidacyError == 0;
                        $newCandidacy = new Candidacy();
                        dd($candidacy);
                        $this->getUser()->getCandidate()->addCandidacy($newCandidacy);
                        $offer->addCandidacy($newCandidacy);
                        $newCandidacy->setCandidate($this->getUser()->getCandidate());
                        $newCandidacy->setOffer($offer);
                        $newCandidacy->setCreatedAt(new DateTimeImmutable());

                        $entityManager->flush();

                        return $this->render('offer/show.html.twig', [
                            'offer' => $offer,
                            'offers' => $offers,
                            'candidacyError' => $candidacyError
                        ]);
                    }

                } else {
                    $candidacyError = 2;
                    // dd('vous devez metre votre profil en available');
                    return $this->render('offer/show.html.twig', [
                        'offer' => $offer,
                        'offers' => $offers,
                        'candidacyError' => $candidacyError
                    ]);
                }

            } else {
                $candidacyError = 3;
                // dd("profil candidat non complet");
                return $this->render('offer/show.html.twig', [
                    'offer' => $offer,
                    'offers' => $offers,
                    'candidacyError' => $candidacyError
                ]);
            }

        } else {
            return $this->redirectToRoute('app_login');
        }
    }
}
