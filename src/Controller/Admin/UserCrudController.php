<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('User')
            ->setSearchFields(['id', 'email', 'roles', 'name']);
    }

    public function configureFields(string $pageName): iterable
    {
        $email = TextField::new('email');
        $password = TextField::new('password');
        $name = TextField::new('name');
        $stockings = AssociationField::new('stockings');
        $id = IntegerField::new('id', 'ID');
        $roles = TextField::new('roles');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $email, $name, $stockings];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $email, $roles, $password, $name, $stockings];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$email, $password, $name, $stockings];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$email, $password, $name, $stockings];
        }
    }
}
