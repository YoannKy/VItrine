<?php
namespace Application\Factory;


use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Mvc\Controller\ControllerManager;
use Application\Service\UserService;
use Application\Controller\AuthentificationController;

class AuthentificationControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        
        $authentificationService =  $controllerManager->getServiceLocator()->get('authentification_service');
        $userService = $controllerManager->getServiceLocator()->get('user_service');
        $controller = new AuthentificationController($authentificationService,$userService);
        return $controller;
    }
}