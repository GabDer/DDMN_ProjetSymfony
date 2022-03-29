<?php

namespace App\Form;

use App\Entity\PERSONNE;
use App\Entity\ENTREPRISE;
use App\Repository\ENTREPRISERepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('PER_NOM', TextType::class)
            ->add('PER_PRENOM', TextType::class)
            ->add('PER_TEL', TelType::class)
            ->add('PER_MAIL', EmailType::class)
            ->add('ENTREPRISE', EntityType::class,
                array(
                    'class'=>ENTREPRISE::class,
                    'choice_label'=>'ent_raison_sociale',
                )
            )
            // ->add('ENTREPRISE', EntityType::class, 
            //     array(
            //         'class' => 'App\Entity\ENTREPRISE', 
            //         //'choice_label' => function($entreprise){ return $entreprise->getDisplayName(); },
            //         'multiple' => false, 
            //         'query_builder' => function( ENTREPRISERepository $entityRepository){ return $entityRepository->createQueryBuilder('e')->orderBy('e.ENT_RaisonSociale');}
            //     )
            //)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PERSONNE::class,
        ]);
    }
}
