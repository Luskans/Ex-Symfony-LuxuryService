<?php

namespace App\Controller\Admin;

use App\Entity\Candidacy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CandidacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidacy::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
