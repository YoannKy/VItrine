<?php
namespace Application\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Application\Service\ProductService;

class ProductServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ProductService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        return $service;
    }
}