<?php

namespace App\Form;

use App\Entity\Profile;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sex',ChoiceType::class,[
                "label"=>false,
                "required"=>false,
                "choices"=>[
                    "Не указано"=>"Не указано",
                    "Мужской"=>"Мужской",
                    "Женский"=>"Женский",
                ],
                "attr"=>[
                    "class"=>"infoInputSex",
                    "placeholder"=>"Пол"
                ]
            ])
            ->add("age",IntegerType::class,[
                "label"=>false,
                "required"=>false,
                "attr"=>[
                    "class"=>"infoInput",
                    "placeholder"=>"Возраст"
                ]
            ])
            ->add('city',TextType::class,[
                "label"=>false,
                "required"=>false,
                "attr"=>[
                    "class"=>"infoInput",
                    "placeholder"=>"Город"
                ]
            ])
            ->add('about',CKEditorType::class,[
                "required"=>false,
                "label"=>false,
                "config"=>[
                    "uiColor"=>"#000000",
                    "language"=>"ru",
                ],
                "attr"=>[
                    "placeholder"=>"Расскажите о себе"
                ]

            ])
            ->add('submit',SubmitType::class,[
                "label"=>"Сохранить изменения",
                "attr"=>[
                    "class"=>"saveBtn",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
            'allow_extra_fields' => true
        ]);
    }
}
