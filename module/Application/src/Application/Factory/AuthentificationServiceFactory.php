<?php
namespace Application\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class AuthentificationServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $service = $serviceManager->get('doctrine.authenticationservice.orm_default');
        return $service;
    }
}