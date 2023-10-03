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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            TextareaField::new('description')
                ->hideOnIndex(),
            // TextField::new('type'),
            ChoiceField::new('type')->setChoices([
                'Full time' => 'full time',
                'Part time' => 'part time',
                'Temporary' => 'temporary',
                'Freelance' => 'freelance',
                'Seasonal' => 'seasonal',
            ]),
            TextField::new('location')
                ->hideOnIndex(),
            // TextField::new('sector')
            //     ->hideOnIndex(),
            ChoiceField::new('sector')
                ->hideOnIndex()
                ->setChoices([
                    'Commercial' => 'commercial',
                    'Retail sales' => 'retail sales',
                    'Creative' => 'creative',
                    'Technology' => 'technology',
                    'Marketing & PR' => 'marketing & pr',
                    'Fashion & Luxury' => 'fashion & luxury',
                    'Management & HR' => 'management & hr'
                    ]),
            IntegerField::new('salary')
                ->hideOnIndex()
                ->setLabel('salary (€)'),
            BooleanField::new('isActivate'),
            DateTimeField::new('createdAt')
                ->hideOnForm(),
            DateField::new('closeAt'),
            TextareaField::new('notes')
                ->hideOnIndex(),
            AssociationField::new('candidacies'),
            ArrayField::new('candidacies')
                ->hideOnIndex(),
        ];
    }


}
