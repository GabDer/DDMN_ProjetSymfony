<?php

namespace App\Form;

use App\Entity\FONCTION;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FonctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FON_LIBELLE', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Fonction']))
            ->add('FonctionPersonne', CollectionType::class, array('label'=>false, 'attr'=>['placeholder'=>'Prénom']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FONCTION::class,
        ]);
    }
}
