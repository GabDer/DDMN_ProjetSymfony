<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('UTI_Login', TextType :: class, ['label' => false, 'attr'=> ['placeholder' => 'Login' ]])
            ->add('UTI_MDP', PasswordType :: class, ['label' => false, 'attr'=> ['placeholder' => 'Mot de passe' ]])
            ->add('UTI_Role', ChoiceType::class,
                array(
                    'choices'=>
                        [
                            'Admin'=>1, 
                            'Enseignant'=>0,
                        ],
                    'label'=>false,
                    'attr'=>
                        [
                            'placeholder'=> 'Role',
                            'class'=>'unRole',
                        ]
                )
            )
            ->add('Valider', SubmitType :: class, ['label' => 'Se connecter'])
        ;
    }

}
