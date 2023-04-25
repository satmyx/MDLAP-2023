<?php

namespace App\Controller\Admin;

use App\Entity\Inscription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class InscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscription::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('licencie'),
            AssociationField::new('loger'),
            DateTimeField::new('dateInscription'),
            AssociationField::new('etat'),
        ];
    }
}
