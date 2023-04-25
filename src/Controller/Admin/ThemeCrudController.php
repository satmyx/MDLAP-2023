<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use App\Entity\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Theme::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            AssociationField::new('atelier'),
            
        ];
    }
}
