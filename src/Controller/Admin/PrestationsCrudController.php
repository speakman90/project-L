<?php

namespace App\Controller\Admin;

use App\Entity\Prestations;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrestationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestations::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('description'),
            TextField::new('name')->setFormType(VichImageType::class)
                                  ->onlyOnForms(),
            ImageField::new('name')->setBasePath('/uploads/prestations')
                                   ->setUploadDir('public/uploads/prestations')
        ];
    }

}
