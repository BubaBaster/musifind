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

class SearchByGenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genre', EntityType::class,
                [
                    'multiple' => false,
                    "label" => "Выберите жанр",
                    "required" => false,
                    'mapped' => false,
                    'class' => Genres::class,
                    'attr' => [
                        'class' => 'js-example-basic-single col-12 d-block form-control',
                        "style" => "width: 85%",
                    ]
                ]
            )
            ->add('submit', SubmitType::class, [
                "label" => "Искать",
                "attr" => [
                    "class" => "someBtn btn btn-success mt-3",
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true
        ]);
    }
}
