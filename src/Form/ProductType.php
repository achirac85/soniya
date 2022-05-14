<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{


    public function builForm(FormBuilderInterface  $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            "label" => "Nom",
            'attr' => ['class' => 'form-control', 'placeholder' => 'Tapez le nom du produit']
        ])
            ->add('price', MoneyType::class,  [
                "label" => "Prix",
                'attr' => ['class' => 'form-control', 'placeholder' => 'Tapez le prix du produit']
            ])
            ->add('slug', TextType::class,  [
                "label" => "slug",
                'attr' => ['class' => 'form-control', 'placeholder' => 'Mettez le slug ici']
            ])

            ->add('category', EntityType::class,  [
                "label" => "Numero de la catégorie",
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('description', TextareaType::class,  [
                "label" => "Description",
                'attr' => ['class' => 'form-control', 'placeholder' => 'Tapez la description du produit']
            ])
            ->add('picture', FileType::class, [
                "mapped" => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
