<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Backoffice\Controller\CategoryController;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $entityService = $controllerManager->getServiceLocator()->get('category_service');
//         $form = $controllerManager->getServiceLocator()->get('category_form');

        $controller = new CategoryController($entityService/*,$form*/);
        
        return $controller;
    }
}