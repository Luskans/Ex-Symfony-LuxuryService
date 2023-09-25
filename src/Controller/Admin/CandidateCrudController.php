<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
            IdField::new('id')
                ->hideOnIndex(),
            // TextField::new('gender'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            AssociationField::new('user'),
            TextField::new('city'),
            TextField::new('adress')
                ->hideOnIndex(),
            TextField::new('country')
                ->hideOnIndex(),
            TextField::new('nationality')
                ->hideOnIndex(),
            BooleanField::new('havePassport')
                ->hideOnIndex(),
            TextField::new('passport')
                ->hideOnIndex(),
            TextField::new('curriculum')
                ->hideOnIndex(),
            // ImageField::new('picture')
            //     ->hideOnIndex(),
            DateField::new('dateOfBirth')
                ->hideOnIndex(),
            TextField::new('placeOfBirth')
                ->hideOnIndex(),
            TextField::new('sector'),
            TextField::new('experience')
                ->hideOnIndex(),
            TextEditorField::new('description')
                ->hideOnIndex(),
            TextEditorField::new('note')
                ->hideOnIndex(),
            DateField::new('createdAt'),
            DateField::new('updatedAt')
                ->hideOnIndex(),
            DateField::new('deletedAt')
                ->hideOnIndex(),
            TextField::new('file')
                ->hideOnIndex(),
            BooleanField::new('isAvailable'),
            BooleanField::new('isDeleted')
                ->hideOnIndex(),
            AssociationField::new('candidacies'),
            ArrayField::new('candidacies')
                ->hideOnIndex(),
        ];
    }
    
}
