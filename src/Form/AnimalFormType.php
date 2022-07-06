<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AnimalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'animal",
            ])
            ->add('picture')
            ->add('description')
            ->add('health_sheet')
            ->add('birthdate')
            ->add('slaughter_date')
            ->add('producer')
            ->add('breed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
             // Nos attributs HTML
             'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
