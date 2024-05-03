<?php

namespace App\Controller\Admin;

use App\Entity\Projets;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjetsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projets::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('lien'),
            TextField::new('name')->setFormType(VichImageType::class)
                                  ->onlyOnForms(),
            ImageField::new('name')->setBasePath('/uploads/prestations')
                                   ->setUploadDir('public/uploads/prestations')
        ];
    }
}
