<?php

namespace App\Controller\Admin;

use App\Entity\Cupcake;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
            TextField::new('nom'),
            TextEditorField::new('ingredient'),
            TextEditorField::new('recette'),
            AssociationField::new('categorie'),
            ImageField::new('image')->setBasePath('image')->setUploadDir('/public/image'),
            DateTimeField::new('updatedAt'),
            AssociationField::new('auteur')->hideOnForm(),
        ];
    }
    
}
