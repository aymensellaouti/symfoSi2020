<?php

namespace App\Controller\Admin;

use App\Entity\Hobbie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HobbieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hobbie::class;
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
