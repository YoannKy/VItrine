<?php
namespace Application\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Application\Service\AccessControlService;

class AccessControlServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        
        $service = new AccessControlService();
        $service->setAuthentificationService($serviceManager->get('authentification_service'));
        return $service;
    }
}