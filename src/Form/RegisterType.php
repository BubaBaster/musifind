<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
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
            ->add('fullName',TextType::class,[
                "label"=>"Имя",
                "required"=>false,
                "attr"=>[
                ]
            ])
            ->add('password',PasswordType::class,[
                "label"=>"Пароль",
                "required"=>true,
            ])
            ->add('password_confirm',PasswordType::class,[
                "required"=>false,
                "label"=>"Подтверждение пароля",
            ])
            ->add('submit',SubmitType::class,[
                "label"=>"Зарегистрироваться",
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
