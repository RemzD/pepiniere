<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {

        $image = ImageField::new('image')->setBasePath('/uploads/images/articles');
        $imageFile = ImageField::new('imageFile')->setFormType(VichImageType::class);
    
        $fields = [
            TextField::new('title'),
            TextEditorField::new('content'),
            AssociationField::new('category')->autocomplete(),
            AssociationField::new('user')->hideOnForm(),
        ];

        if ( $pageName == Crud::PAGE_INDEX){
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('Article')
        ->setEntityLabelInPlural('Articles')
        ->setSearchFields(['title', 'content'])
        ->setPaginatorPageSize(30);

    }
}
