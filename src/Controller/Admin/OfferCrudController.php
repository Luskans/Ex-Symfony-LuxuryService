<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('client')->autocomplete(),
            TextField::new('reference'),
            TextField::new('title'),
            TextEditorField::new('description')
                ->hideOnIndex(),
            TextField::new('type'),
            TextField::new('location')
                ->hideOnIndex(),
            TextField::new('sector')
                ->hideOnIndex(),
            IntegerField::new('salary')
                ->hideOnIndex(),
            BooleanField::new('isActivate'),
            DateTimeField::new('createdAt')
                ->hideOnForm(),
            DateField::new('closeAt'),
            TextEditorField::new('notes')
                ->hideOnIndex(),
            AssociationField::new('candidacies'),
            ArrayField::new('candidacies')
                ->hideOnIndex(),
        ];
    }


}
