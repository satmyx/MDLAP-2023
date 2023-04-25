<?php

namespace App\Controller\Admin;

use App\Entity\Nuites;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class NuitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nuites::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('categorie'),
            DateTimeField::new('dateNuites'),
        ];
    }
}
