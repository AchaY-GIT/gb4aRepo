<?php

namespace App\Form;

use App\Entity\Contacte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContacteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class,[
            'required' =>true,
        ] )
        ->add('prenom', TextType::class )
        ->add('email',EmailType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your email',
                ]),
            ],
        ])
    

        ->add('sujet', TextType::class)
        ->add('message', TextAreaType::class)
     
            ->add('tel',TelType::class)
            
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacte::class,
        ]);
    }
}
