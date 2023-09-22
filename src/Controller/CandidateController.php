<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidate')]
class CandidateController extends AbstractController
{
    #[Route('/profile', name: 'app_candidate_profile', methods: ['GET'])]
    public function index(CandidateRepository $candidateRepository): Response
    {
        return $this->render('candidate/profile.html.twig', [
            'candidates' => $candidateRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_candidate_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $candidate = new Candidate();
    //     $form = $this->createForm(CandidateType::class, $candidate);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($candidate);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_candidate_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('candidate/new.html.twig', [
    //         'candidate' => $candidate,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_candidate_show', methods: ['GET'])]
    // public function show(Candidate $candidate): Response
    // {
    //     return $this->render('candidate/show.html.twig', [
    //         'candidate' => $candidate,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_candidate_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidate $candidate, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate->setUpdatedAt(new DateTimeImmutable());

            // $user->setPassword(
            //     $userPasswordHasher->hashPassword(
            //         $user,
            //         $form->get('password')->getData()
            //     )
            // );



            $entityManager->flush();

            return $this->redirectToRoute('app_candidate_edit', ['id' => $candidate->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'candidateForm' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_candidate_delete', methods: ['POST'])]
    // public function delete(Request $request, Candidate $candidate, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$candidate->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($candidate);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_candidate_index', [], Response::HTTP_SEE_OTHER);
    // }
}
