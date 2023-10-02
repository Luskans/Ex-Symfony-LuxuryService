<?php

namespace App\Controller\Admin;

use App\Entity\Candidacy;
use App\Entity\Candidate;
use App\Entity\Client;
use App\Entity\Offer;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface) {
        $this->setEntityManager($entityManagerInterface);
    }

    #[Route('/admin', name: 'admin', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        $candidateRepository = $this->entityManager->getRepository(Candidate::class);
        $candidates = $candidateRepository->findAll();
        
        $candidacyRepository = $this->entityManager->getRepository(Candidacy::class);
        $candidacies = $candidacyRepository->findAll();

        $clientRepository = $this->entityManager->getRepository(Client::class);
        $clients = $clientRepository->findAll();

        $offerRepository = $this->entityManager->getRepository(Offer::class);
        $offers = $offerRepository->findAll();
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig', [
            'candidates' => $candidates,
            'candidacies' => $candidacies,
            'clients' => $clients,
            'offers' => $offers
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-solid fa-info-circle');
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Candidates', 'fa-solid fa-pen', Candidate::class);
        yield MenuItem::linkToCrud('Clients', 'fa-solid fa-building', Client::class);
        yield MenuItem::linkToCrud('Offers', 'fa-solid fa-file-contract', Offer::class);
        yield MenuItem::linkToCrud('Candidacies', 'fa-solid fa-check-to-slot', Candidacy::class);
        yield MenuItem::section('Back');
        yield MenuItem::linkToRoute('Home', 'fa fa-home', 'app_home');
    }

    // public function configureFields(string $pageName): iterable
    // {
    //    <p>hello</p>

    // }

    /**
     * Get the value of entityManager
     */ 
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */ 
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
