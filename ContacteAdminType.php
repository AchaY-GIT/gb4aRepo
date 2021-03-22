<?php

namespace App\Form;

use App\Entity\Contacte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContacteAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class )
        ->add('prenom', TextType::class )
        ->add('email', EmailType::class )

        ->add('sujet', TextType::class)
        ->add('message', TextAreaType::class)
        ->add('produit', EntityType::class,[
            // looks for choices from this entity
            'class' => Produits::class,

            // uses the User.username property as the visible option string
            'choice_label' => 'nom',

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ]) 
      
        ->add('service', EntityType::class,[
            // looks for choices from this entity
            'class' => SousCategories::class,

            // uses the User.username property as the visible option string
            'choice_label' => 'titre',

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ]) 
     
            ->add('tel',TelType::class)
            ->add('produit')
            ->add('solution')
            ->add('service')
            ->add('reponce')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacte::class,
        ]);
    }
}
