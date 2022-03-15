<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email', TextType :: class, ['label' => false, 'attr'=> ['placeholder' => 'Adresse e-mail' ]])
            ->add('Mdp', PasswordType :: class, ['label' => false, 'attr'=> ['placeholder' => 'Mot de passe' ]])
            ->add('Valider', SubmitType :: class, ['label' => 'Se connecter'])
        ;
    }

}
