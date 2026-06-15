<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextEditorField::new('content', 'Description'),
            MoneyField::new('prix', 'Prix')->setCurrency('EUR'),
            BooleanField::new('isPublished', 'Publier'),
            DateTimeField::new('updatedAt', 'Mis à jour le')->hideOnForm(),
            ImageField::new('image','photo')->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->maxSize(10 * 1024 * 1024)
                ->setRequired(false),

        ];
    }
}
