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
            'offers' => $offers,
        ]);
        
    }

    #[Route('/offer/{id}', name: 'app_offer_show')]
    public function show(Offer $offer, OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAll();
        $candidacyError = 0;
        $previousOffer = $offerRepository->findPreviousOffer($offer);
        $nextOffer = $offerRepository->findNextOffer($offer);

        if ($this->getUser()) {

                    return $this->render('offer/show.html.twig', [
                'offer' => $offer,
                'offers' => $offers,
                'candidacyError' => $candidacyError,
                'previousOffer' => $previousOffer,
                'nextOffer' => $nextOffer
            ]);

        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/offer/{id}/add', name: 'app_offer_add')]
    public function add(Offer $offer, OfferRepository $offerRepository, EntityManagerInterface $entityManager): Response
    {
        $offers = $offerRepository->findAll();
        $previousOffer = $offerRepository->findPreviousOffer($offer);
        $nextOffer = $offerRepository->findNextOffer($offer);
        $candidacyError = 0;
        /**
         * @var User $user
         */
        $user = $this->getUser();

        if ($user) {

            if ($user->getCandidate()->getPercentCompleted() == 100) {

                if  ($user->getCandidate()->isIsAvailable()) {

                    $candidacies = $user->getCandidate()->getCandidacies();
                    $candidacyExist = false;
                    $candidacyError = 0;

                    foreach ($candidacies as $candidacy) {

                        if ($candidacy->getOffer()->getId() === $offer->getId()) {
                            $candidacyExist = true;
                            break;
                        }
                    }

                    if ($candidacyExist) { // if offer already candidated
                        $candidacyError = 1;

                    } else { // if everything is ok
                        $candidacyError == 0;
                        $newCandidacy = new Candidacy();
                        $user->getCandidate()->addCandidacy($newCandidacy);
                        $offer->addCandidacy($newCandidacy);
                        $newCandidacy->setCandidate($user->getCandidate());
                        $newCandidacy->setOffer($offer);
                        $newCandidacy->setCreatedAt(new DateTimeImmutable());

                        $entityManager->flush();
                    }

                } else { // if isAvailable is on 'no'
                    $candidacyError = 2;
                }

            } else { // if candidate profil uncompleted
                $candidacyError = 3;
            }

            return $this->render('offer/show.html.twig', [
                'offer' => $offer,
                'offers' => $offers,
                'candidacyError' => $candidacyError,
                'previousOffer' => $previousOffer,
                'nextOffer' => $nextOffer
            ]);

        } else { // if no user
            return $this->redirectToRoute('app_login');
        }
    }
}
