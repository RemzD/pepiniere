<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CalendarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Calendar::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            DateField::new('start'),
            DateField::new('end'),
            TextEditorField::new('description'),
            BooleanField::new('all_day'),
            ColorField::new('backgroundColor'),
            ColorField::new('borderColor'),
            ColorField::new('textColor'),
        ];
    }
    
}
