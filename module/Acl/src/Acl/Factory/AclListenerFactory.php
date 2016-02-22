<?php
namespace Acl\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Acl\Listener\Acl as AclListener;

class AclListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service =new AclListener($serviceLocator->get('AclService'), $serviceLocator->get('authentification_service'));
        return $service;
    }
}