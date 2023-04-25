<?php

namespace App\Controller\Admin;

use App\Entity\Atelier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AtelierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Atelier::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            IntegerField::new('nbPlaces'),
            AssociationField::new('vacation'),
        ];
    }
    
}
