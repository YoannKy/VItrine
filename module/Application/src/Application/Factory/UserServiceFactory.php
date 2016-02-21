<?php
namespace Application\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Application\Service\UserService;

class UserServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new UserService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}