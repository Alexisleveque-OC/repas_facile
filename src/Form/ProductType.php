<?php

namespace App\Form;

use App\Entity\MesureType;
use App\Entity\Month;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    "attr" => [
                        'label' => "Nom de l'ingrédient",
                    ],
                ]
            )
            ->add('description', TextareaType::class)
            ->add(
                'month_begin',
                ChoiceType::class,
                [
                    'label'   => 'Début de consommation',
                    'choices' => [
                        '-------'   => null,
                        'Janvier'   => 'Janvier',
                        'Février'   => 'Février',
                        'Mars'      => 'Mars',
                        'Avril'     => 'Avril',
                        'Mai'       => 'Mai',
                        'Juin'      => 'Juin',
                        'Juillet'   => 'Juillet',
                        'Août'      => 'Août',
                        'Septembre' => 'Septembre',
                        'Octobre'   => 'Octobre',
                        'Novembre'  => 'Novembre',
                        'Décembre'  => 'Décembre',
                    ],
                ]
            )
            ->add(
                'month_end',
                ChoiceType::class,
                [
                    'label'   => 'Fin de consommation',
                    'choices' => [
                        '-------'   => null,
                        'Janvier'   => 'Janvier',
                        'Février'   => 'Février',
                        'Mars'      => 'Mars',
                        'Avril'     => 'Avril',
                        'Mai'       => 'Mai',
                        'Juin'      => 'Juin',
                        'Juillet'   => 'Juillet',
                        'Août'      => 'Août',
                        'Septembre' => 'Septembre',
                        'Octobre'   => 'Octobre',
                        'Novembre'  => 'Novembre',
                        'Décembre'  => 'Décembre',
                    ],
                ]
            )
            ->add(
                'mesureType',
                EntityType::class,
                [
                    'label'        => 'Type de mesure',
                    'required'     => true,
                    'class'        => MesureType::class,
                    'choice_label' => 'name',
                ]
            )
            ->add(
                'type',
                EntityType::class,
                [
                    'label'        => 'Type de mesure',
                    'required'     => true,
                    'class'        => \App\Entity\ProductType::class,
                    'choice_label' => 'name',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Product::class,
            ]
        );
    }
}
