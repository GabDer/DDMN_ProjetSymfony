<?php

namespace App\Form;

use App\Entity\ENTREPRISE;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ENT_RaisonSociale', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Raison sociale']))
            ->add('ENT_Pays', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Pays']))
            ->add('ENT_Ville', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Ville']))
            ->add('ENT_CP', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Code postale']))
            ->add('ENT_RUE', TextType::class, array('label'=>false, 'attr'=>['placeholder'=>'Rue']))
            ->add('ENT_ComplementAdresse', TextType::class, array('required' => false, 'label'=>false, 'attr'=>['placeholder'=>'Complément d\'adresse']))
            ->add('ENT_NUM1', TextType::class, array('required' => false, 'label'=>false, 'attr'=>['placeholder'=>'Numero 1']))
            ->add('ENT_NUM2', TextType::class, array('required' => false, 'label'=>false, 'attr'=>['placeholder'=>'Numero 2']))
            ->add('ENT_SiteWeb', UrlType::class, array('required' => false, 'label'=>false, 'attr'=>['placeholder'=>'URL site web']))
            // ->add('ENT_AVOIR', CheckboxType::class, ['label'=> '])
            //->add('ENT_AVOIR', TextType::class)
            ->add('Valider', SubmitType :: class, ['label' => 'Sauvegarder'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ENTREPRISE::class,
        ]);
    }
}
