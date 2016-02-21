<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach (__NAMESPACE__ , 'dispatch' , function ($e) {
            $e->getTarget()->layout ('login/layout');
        }) ;
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'authentification_service' => function($serviceManager) {
                    // If you are using DoctrineORMModule:
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                },
                'category_service' => 'Application\Factory\CategoryServiceFactory',
                'AddressService' => 'Application\Factory\AddressServiceFactory',
                'product_service' => 'Application\Factory\ProductServiceFactory',
                'user_service' => 'Application\Factory\UserServiceFactory',
                'WishlistService' => 'Application\Factory\Whishlist.php',
            )
        );
    }
}
