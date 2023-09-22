<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // TextField::new('gender'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('city'),
            TextField::new('adress'),
            TextField::new('country'),
            TextField::new('nationality'),
            BooleanField::new('havePassport'),
            TextField::new('passport'),
            TextField::new('curriculum'),
            TextField::new('picture'),
            DateField::new('dateOfBirth'),
            TextField::new('placeOfBirth'),
            BooleanField::new('isAvailable'),
            TextField::new('sector'),
            TextField::new('experience'),
            TextEditorField::new('description'),
            TextEditorField::new('note'),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
            DateField::new('deletedAt'),
            TextField::new('file'),
            BooleanField::new('isDeleted'),
            // TextField::new('user'),
            // TextField::new('offers'),
        ];
    }
    
}
