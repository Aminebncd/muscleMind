<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercice::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('exerciceName', 'Exercice Name'),
            TextEditorField::new('exerciceFunction', 'Exercice Function'),
            AssociationField::new('target', 'Primary Target Muscle'),
            AssociationField::new('secondaryTarget', 'Secondary Target Muscle'),
            TextEditorField::new('howToPerform', 'How to Perform')->hideOnIndex(),
            TextEditorField::new('proTip', 'Pro Tip')->hideOnIndex(),
            UrlField::new('videoExplication', 'Video Explanation')->hideOnIndex(),
            AssociationField::new('performances', 'Performances')
                ->hideOnForm(), // Hide on form to prevent bidirectional relationship issues
            AssociationField::new('workoutPlans', 'Workout Plans')
                ->hideOnForm(), // Hide on form to prevent bidirectional relationship issues
        ];
    }
}
