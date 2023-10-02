<?php

namespace App\Controller\Admin;

use App\Entity\Candidacy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CandidacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidacy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            AssociationField::new('candidate'),
            AssociationField::new('offer'),
            DateField::new('createdAt'),
        ];
    }
}
