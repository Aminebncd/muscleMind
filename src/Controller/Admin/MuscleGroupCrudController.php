<?php

namespace App\Controller\Admin;

use App\Entity\MuscleGroup;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MuscleGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MuscleGroup::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('muscleGroup', 'Muscle Group'),
            ImageField::new('muscleGroupImage', 'Image')
                ->setBasePath('/img/muscleGroups')
                ->setUploadDir('public/img/muscleGroups')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('muscleGroupSvgFront', 'SVG Front')
                ->setBasePath('/svgs')
                ->setUploadDir('public/svgs')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('muscleGroupSvgBack', 'SVG Back')
                ->setBasePath('/svgs')
                ->setUploadDir('public/svgs')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('muscles', 'Muscles')
                ->hideOnForm(), // Hide this field on forms to avoid issues with bidirectional relationships
        ];
    }
}
