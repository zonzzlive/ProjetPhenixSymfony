<?php

namespace App\Controller\Admin;

use App\Entity\TeamMembre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TeamMembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeamMembre::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
