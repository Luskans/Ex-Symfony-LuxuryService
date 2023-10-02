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
use Symfony\Component\DomCrawler\Field\FileFormField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $rootDir = $this->getParameter('kernel.project_dir');
        return [
            IdField::new('id')
                ->hideOnIndex()
                ->hideOnForm(),
            // TextField::new('gender'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            AssociationField::new('user')
                ->setLabel('Email'),
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
            ImageField::new('passport')
                ->setBasePath('/public/assets/img/uploads/passports/')
                ->setUploadDir('/public/assets/img/uploads/passports')
                ->setUploadedFileNamePattern(
                    fn (UploadedFile $file): string => sprintf(uniqid('', true) . '.' . $file->guessExtension())
                ),
            TextField::new('curriculum')
                ->hideOnIndex(),
            ImageField::new('curriculum')
                ->setBasePath('/public/assets/img/uploads/curriculum/')
                ->setUploadDir('/public/assets/img/uploads/curriculum')
                ->setUploadedFileNamePattern(
                    fn (UploadedFile $file): string => sprintf(uniqid('', true) . '.' . $file->guessExtension())
                ),
            TextField::new('picture')
                ->hideOnIndex(),
            ImageField::new('picture')
                ->setBasePath('/public/assets/img/uploads/pictures/')
                ->setUploadDir('/public/assets/img/uploads/pictures')
                ->setUploadedFileNamePattern(
                    fn (UploadedFile $file): string => sprintf(uniqid('', true) . '.' . $file->guessExtension())
                ),
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
            DateField::new('createdAt')
                ->hideOnForm(),
            DateField::new('updatedAt')
                ->hideOnIndex()
                ->hideOnForm(),
            DateField::new('deletedAt')
                ->hideOnIndex()
                ->hideOnForm(),
            TextField::new('file')
                ->hideOnIndex(),
            ImageField::new('file')
            ->setBasePath('/public/assets/img/uploads/files/')
                ->setUploadDir('/public/assets/img/uploads/files')
                ->setUploadedFileNamePattern(
                    fn (UploadedFile $file): string => sprintf(uniqid('', true) . '.' . $file->guessExtension())
                ),
            BooleanField::new('isAvailable'),
            BooleanField::new('isDeleted')
                ->hideOnIndex(),
            AssociationField::new('candidacies'),
            ArrayField::new('candidacies')
                ->hideOnIndex(),
        ];
    }
    
}
