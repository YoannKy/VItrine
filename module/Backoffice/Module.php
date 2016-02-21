<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backoffice;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    
    public function onBootstrap($e) {
    
        $serviceManager = $e->getApplication()->getServiceManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $authService = $serviceManager->get('authentification_service');
        $myService = $serviceManager->get('category_service');
        $viewModel->categories = $myService->findAll();
        $viewModel->authService = $authService;
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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

    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__, 'dispatch', function($e) {
            $e->getTarget()->layout('layout/layout');
        });
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'category_form' => 'Backoffice\Factory\CategoryFormFactory.php',
                )
            );
    }
}
