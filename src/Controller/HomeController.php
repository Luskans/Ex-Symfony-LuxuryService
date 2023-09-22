<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findTenByCreatedAt();



        return $this->render('home/index.html.twig', [
            'offers' => $offers
        ]);
    }

    #[Route('/company', name: 'app_company')]
    public function company(): Response
    {
        return $this->render('home/company.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}


// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// class CandidateController extends AbstractController
// {
//     #[Route('/candidate/profile', name: 'app_candidate_profile')]
//     public function index(): Response
//     {
//         return $this->render('candidate/profile.html.twig', [
//             'controller_name' => 'CandidateController',
//         ]);
//     }
// }
