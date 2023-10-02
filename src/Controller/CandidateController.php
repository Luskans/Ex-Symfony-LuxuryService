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
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

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
        $rootDir = $this->getParameter('kernel.project_dir');

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate->setUpdatedAt(new DateTimeImmutable());
      
            // On change le nom et met le fichier picture dans les uploads
            $directory1 = $rootDir . '/public/assets/img/uploads/passports';
            $passport = $form['passport']->getData();
            if ($passport) {
                $extension1 = $passport->guessExtension();
                if (!$extension1) {
                    $extension1 = 'bin';
                }
                $uuid1 = Uuid::v7();
                $passportName = $uuid1 . '.' . $extension1;
                $passport->move($directory1, $passportName);
                $candidate->setPassport($passportName);
            }

            // On change le nom et met le fichier picture dans les uploads
            $directory2 = $rootDir . '/public/assets/img/uploads/curriculum';
            $curriculum = $form['curriculum']->getData();
            if ($curriculum) {
                $extension2 = $curriculum->guessExtension();
                if (!$extension2) {
                    $extension2 = 'bin';
                }
                $uuid2 = Uuid::v7();
                $curriculumName = $uuid2 . '.' . $extension2;
                $curriculum->move($directory2, $curriculumName);
                $candidate->setCurriculum($curriculumName);
            }

            // On change le nom et met le fichier picture dans les uploads
            $directory3 = $rootDir . '/public/assets/img/uploads/pictures';
            $picture = $form['picture']->getData();
            if ($picture) {
                $extension3 = $picture->guessExtension();
                if (!$extension3) {
                    $extension3 = 'bin';
                }
                $uuid3= Uuid::v7();
                $pictureName = $uuid3 . '.' . $extension3;
                $picture->move($directory3, $pictureName);
                $candidate->setPicture($pictureName);
            }

            // Si on recoit un passport, on change le havePassport
            if ($candidate->getPassport()) {
                $candidate->setHavePassport(true);
            } else {
                $candidate->setHavePassport(false);
            }

            // On vérifie les champs pour augmenter le percentCompleted
            $candidate->setPercentCompleted($candidate->checkPercentCompleted());
            

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
