<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidateController extends AbstractController
{
    #[Route('/candidate/profile', name: 'app_candidate_profile')]
    public function index(): Response
    {
        return $this->render('candidate/profile.html.twig', [
            'controller_name' => 'CandidateController',
        ]);
    }
}
