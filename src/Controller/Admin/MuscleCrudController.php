<?php

namespace App\Controller\Admin;

use App\Entity\Muscle;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MuscleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Muscle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('muscleName', 'Muscle Name'),
            TextEditorField::new('muscleFunction', 'Muscle Function'),
            AssociationField::new('muscleGroup', 'Muscle Group'),
            AssociationField::new('exercices', 'Exercices')
                ->hideOnForm(), // Hide on form to prevent bidirectional relationship issues
            // AssociationField::new('subExercices', 'Secondary Exercices')
            //     ->hideOnForm(), // Hide on form to prevent bidirectional relationship issues
        ];
    }
}
