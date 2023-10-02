<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'Transgender' => 'transgender'
                ],
                'attr' => [
                    'id' => 'gender',
                ],
                'label' => 'Gender',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'id' => 'first_name',
                    'class' => 'form-control',
                ],
                'label' => 'First name'
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'id' => 'last_name',
                    'class' => 'form-control',
                ],
                'label' => 'Last name'
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'current_location',
                ],
                'label' => 'Current Location'
            ])
            ->add('adress', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'address',
                ],
                'label' => 'Address'
            ])
            ->add('country', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'country',
                ],
                'label' => 'Country'
            ])
            ->add('nationality', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'nationality',
                ],
                'label' => 'Nationality'
            ])
            ->add('passport', FileType::class, [
                'mapped' => false, // permet de ne pas hydrater l'entité
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
                    'type' => 'file'
                ]
            ])
            ->add('curriculum', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'cv',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'cv',
                    'type' => 'file'
                ]
            ])
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'photo',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'photo',
                    'type' => 'file'
                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'id' => 'birth_date',
                    'class' => 'datepicker',
                ],
                'label' => 'Birthdate',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('placeOfBirth', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'birth_place',
                ],
                'label' => 'Birthplace'
            ])
            ->add('sector', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Commercial' => 'commercial',
                    'Retail sales' => 'retail sales',
                    'Creative' => 'creative',
                    'Technology' => 'technology',
                    'Marketing & PR' => 'marketing & pr',
                    'Fashion & luxury' => 'fashion & luxury',
                    'Management & HR' => 'management & hr',
                ],
                'attr' => [
                    'id' => 'job_sector',
                ],
                'label' => 'Interest in job sector',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    '0 - 6 month' => '0 - 6 month',
                    '6 month - 1 year' => '6 month - 1 year',
                    '1 -2 years' => '1 -2 years',
                    '2+ years' => '2+ years',
                    '5+ years' => '5+ years',
                    '10+ years' => '10+ years',
                ],
                'attr' => [
                    'id' => 'experience',
                ],
                'label' => 'Experience',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'description',
                    'class' => 'materialize-textarea',
                    'cols' => '50',
                    'rows' => '10',
                ],
                'label' => 'Short description for your profile, as well as more personnal informations (e.g. your hobbies/interests ). You can also paste any link you want.'
            ])
            ->add('isAvailable', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'attr' => [
                    'id' => 'isAvailable',
                ],
                'label' => 'Are you currently available ?',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('user', UserType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
