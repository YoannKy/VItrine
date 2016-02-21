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
        $entityService = $controllerManager->getServiceLocator()->get('product_service');
        $controller->setProductService($entityService);
        return $controller;
    }
}