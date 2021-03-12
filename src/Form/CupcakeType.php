<?php

namespace App\Form;

use App\Entity\Cupcake;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CupcakeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('imageFile', FileType::class, ['required'=>false])
            ->add('ingredient')
            ->add('recette')
            ->add('categorie', EntityType::class, [
                'class'=> Categorie::class, 
                'choice_label' => 'nom_cat',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cupcake::class,
        ]);
    }
}
