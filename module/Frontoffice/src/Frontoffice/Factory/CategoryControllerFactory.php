<?php
namespace Frontoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Frontoffice\Controller\CategoryController;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $controller = new CategoryController();
        $entityService = $controllerManager->getServiceLocator()->get('category_service');
        $controller->setCategoryService($entityService);
        return $controller;
    }
}