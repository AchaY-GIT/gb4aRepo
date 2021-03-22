<?php

namespace App\Form;

use App\Entity\Services;
use App\Entity\Categories;
use App\Entity\SousCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('images')
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
            ->add('image',FileType::class,[
                'label' => false,
                'mapped' =>false,
                'required'=>false,

         ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
