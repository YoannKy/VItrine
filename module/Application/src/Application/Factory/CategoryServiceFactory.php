<?php
namespace Application\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Application\Service\CategoryService;

class CategoryServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new CategoryService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}