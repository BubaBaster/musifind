<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login',TextType::class,[
                "label"=>"Логин",
                "required"=>true,
                "attr"=>[
                ]
            ])
            ->add('password',PasswordType::class,[
                "label"=>"Пароль",
                "required"=>true,
            ])
            ->add('submit',SubmitType::class,[
                "label"=>"Войти",
                "attr"=>[
                    "class"=>"loginBtn",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
