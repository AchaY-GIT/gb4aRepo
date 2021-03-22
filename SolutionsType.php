<?php

namespace App\Form;

use App\Entity\Solutions;
use App\Entity\SousCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SolutionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('image',FileType::class,[
                'label' => false,
                'mapped' =>false,
                'required'=>false,
         ])
            ->add('categorie', EntityType::class,[
                // looks for choices from this entity
                'class' => Categories::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'metier',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('sousCategories', EntityType::class,[
                // looks for choices from this entity
                'class' => SousCategories::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'type',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Solutions::class,
        ]);
    }
}
