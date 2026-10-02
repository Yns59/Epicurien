<?php

namespace App\Controller\Admin;



use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class Menucrudcontroller extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextEditorField::new('content', 'Description'),
            MoneyField::new('price', 'Prix')->setCurrency('EUR')];

}
}
