<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Réservation')
            ->setEntityLabelInPlural('Réservations')
            ->setDefaultSort(['date' => 'ASC', 'hour' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            EmailField::new('email', 'Email'),
            TelephoneField::new('phoneNumber', 'Téléphone'),
            DateField::new('date', 'Date'),
            ChoiceField::new('hour', 'Heure')->setChoices($this->getTimeSlots()),
            IntegerField::new('cutlery', 'Couverts'),
            TextareaField::new('content', 'Message')->hideOnIndex(),
        ];
    }

    private function getTimeSlots(): array
    {
        $slots = [];
        foreach ([[720, 840], [1140, 1320]] as [$start, $end]) {
            for ($m = $start; $m <= $end; $m += 30) {
                $slots[sprintf('%02d:%02d', intdiv($m, 60), $m % 60)] = $m;
            }
        }

        return $slots;
    }
}
