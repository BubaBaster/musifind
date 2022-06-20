<?php

namespace App\Form;

use App\Entity\Genres;
use App\Entity\Profile;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('genres', EntityType::class,
                [
                    'multiple' => true,
                    "label" => "Любимые жанры",
                    "required" => false,
                    'mapped' => false,
                    'class' => Genres::class,
                    'attr' => [
                        'class' => 'js-example-basic-single col-12 d-block form-control',
                        "style" => "width: 85%",
                    ]
                ]
            )
            ->add('sex', ChoiceType::class, [
                "label" => "Пол",
                "required" => false,
                "choices" => [
                    "Не указано" => "Не указано",
                    "Мужской" => "Мужской",
                    "Женский" => "Женский",
                ],
                "attr" => [
                    "class" => "infoInputSex",
                    "placeholder" => "Пол"
                ]
            ])
            ->add("age", IntegerType::class, [
                "label" => "Возраст",
                "required" => false,
                "attr" => [
                    "class" => "infoInput",
                    "placeholder" => "Возраст"
                ]
            ])
            ->add('city', TextType::class, [
                "label" => "Город",
                "required" => false,
                "attr" => [
                    "class" => "infoInput",
                    "placeholder" => "Город",
                    "style" => "background: #464646 !important; text-indent: 11px;",
                ]
            ])
            ->add('vklink', TextType::class, [
                "label" => "Социальные сети",
                "required" => false,
                "attr" => [
                    "class" => "infoInput",
                    "placeholder" => "Ссылка на страницу VK",
                    "style" => "background: #464646 !important; text-indent: 11px;",
                ]
            ])
            ->add('instlink', TextType::class, [
                "label" => false,
                "required" => false,
                "attr" => [
                    "class" => "infoInput",
                    "placeholder" => "Имя пользователя Instagram",
                    "style" => "background: #464646 !important; text-indent: 11px;",
                ]
            ])
            ->add('tglink', TextType::class, [
                "label" => false,
                "required" => false,
                "attr" => [
                    "class" => "infoInput",
                    "placeholder" => "Имя пользователя Telegram",
                    "style" => "background: #464646 !important; text-indent: 11px;",
                ]
            ])
            ->add('about', CKEditorType::class, [
                "required" => false,
                "label" => "О себе",
                "config" => [
                    "uiColor" => "#000000",
                    "language" => "ru",
                    "resize_enabled"=> false,
                ],
                "attr" => [
                    "placeholder" => "Расскажите о себе"
                ]

            ])
            ->add('submit', SubmitType::class, [
                "label" => "Сохранить изменения",
                "attr" => [
                    "class" => "saveBtn btn btn-success",
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
            'allow_extra_fields' => true
        ]);
    }
}
