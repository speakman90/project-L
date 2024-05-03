<?php

namespace App\Controller\Admin;

use App\Entity\About;

use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('description'),
            TextField::new('name')->setFormType(VichImageType::class)
                                  ->onlyOnForms(),
            ImageField::new('name')->setBasePath('/uploads/about')
                                   ->setUploadDir('/public/uploads/about'),
            TextField::new('alt_picture')
        ];
        
    }
}
