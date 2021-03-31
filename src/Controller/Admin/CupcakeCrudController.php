<?php

namespace App\Controller\Admin;

use App\Entity\Cupcake;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CupcakeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cupcake::class;
    }


    public function configureFields(string $cupcake): iterable
    {
        return [
            
            TextField::new('nom','Nom de la recette'),
            TextareaField::new('ingredient','Ingrédient'),
            TextareaField::new('recette', 'Recette'),
            AssociationField::new('categorie','Catégorie'),
            ImageField::new('image','Image')->setBasePath('image')->setUploadDir('/public/image'),
            DateTimeField::new('updatedAt', 'Date de mise à jour'),
            AssociationField::new('auteur','Auteur')->hideOnForm(),
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('auteur')
            ->add(EntityFilter::new('categorie', 'Catégorie'))
            ->add(TextFilter::new('nom', 'nom de la recette'))
        ;
    }
}
