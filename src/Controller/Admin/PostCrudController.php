<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Articles');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            ImageField::new(propertyName: 'image', label: 'Image')
                ->setBasePath('/images')
                ->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextField::new(propertyName: 'imageFile', label: 'Image')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                ])
                ->onlyOnForms(),
            DateTimeField::new(propertyName: 'createdAt', label: 'Date de création')
                ->hideOnForm(),

            DateTimeField::new(propertyName: 'updatedAt', label: 'Date de modification')
                ->hideOnForm(),
        ];
    }
}
