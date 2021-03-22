<?php

namespace App\Form;

use App\Entity\Contacte;
use App\Entity\Produits;
use App\Entity\Services;
use App\Entity\Solutions;
use App\Entity\Categories;
use App\Entity\SousCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContacteDevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        ->add('sujet', TextType::class)
        ->add('message', TextAreaType::class)
             
            
            
            ->add('produit', EntityType::class,[
                // looks for choices from this entity
                'class' => Produits::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
                'placeholder' => 'champs optionnelle: Choisisez le produit qui vous interesse',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]) 
            ->add('solution',EntityType::class,[
                // looks for choices from this entity
                'class' => Solutions::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'titre',
                'placeholder' => 'champs optionnelle: Choisisez la solution qui vous interesse',
                'required' => 'false'
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]) 
            ->add('service', EntityType::class,[
                // looks for choices from this entity
                'class' => Services::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'titre',
                'placeholder' => 'champs optionnelle: Choisisez le service qui vous interesse',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacte::class,
        ]);
    }
}
