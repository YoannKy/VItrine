<?php
namespace Frontoffice\Factory;

use Frontoffice\Controller\ProductController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $controller = new ProductController();
        $producService = $controllerManager->getServiceLocator()->get('product_service');
        $controller->setProductService($producService);
        $categoryService = $controllerManager->getServiceLocator()->get('category_service');
        $controller->setCategoryService($categoryService);
        $userService = $controllerManager->getServiceLocator()->get('user_service');
        $controller->setUserService($userService);
        
        return $controller;
    }
}