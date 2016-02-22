<?php
namespace Acl\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Acl\Service\Acl as AclService;
use Zend\Permissions\Acl\Acl;

class AclServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $service = new AclService(new Acl());
        if (!empty($config['acl'])) {
            $service->setup($config['acl']);
        }
        return $service;
    }
}