<?php
namespace Frontoffice\Factory;

use Frontoffice\Controller\WishlistController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WishListControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $controller = new WishlistController();
        $authentificationService =  $controllerManager->getServiceLocator()->get('authentification_service');
        $productService =  $controllerManager->getServiceLocator()->get('product_service');
        $controller->setAuthentificationService($authentificationService);
        $userService =  $controllerManager->getServiceLocator()->get('user_service');
        $controller->setUserService($userService);
        $controller->setProductService($productService);
        return $controller;
    }
}