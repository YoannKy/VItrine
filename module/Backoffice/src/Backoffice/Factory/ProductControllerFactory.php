<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Backoffice\Controller\ProductController;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $productService = $controllerManager->getServiceLocator()->get('product_service');
        $categoryService = $controllerManager->getServiceLocator()->get('category_service');
        
        $controller = new ProductController($productService,$categoryService);
        return $controller;
    }
}