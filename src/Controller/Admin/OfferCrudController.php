<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('isActivate'),
            TextField::new('reference'),
            TextEditorField::new('description'),
            TextField::new('title'),
            TextField::new('type'),
            TextField::new('location'),
            TextField::new('sector'),
            IntegerField::new('salary'),
            DateField::new('closeAt'),
            DateField::new('createdAt'),
            TextEditorField::new('notes'),
        ];
    }
}
