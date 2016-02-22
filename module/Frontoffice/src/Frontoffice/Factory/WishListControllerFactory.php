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
        $controller->setAuthentificationService($authentificationService);
        return $controller;
    }
}