<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Backoffice\Form\CategoryForm;

class CategoryFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $formManager = $serviceLocator->get('FormElementManager');
        $form = $formManager->get('\Backoffice\Form\CategoryForm');
        return new  CategoryForm();
    }
}