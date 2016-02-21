<?php
namespace Frontoffice;

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
    
    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__, 'dispatch', function($e) {
            $e->getTarget()->layout('layout/front_layout');
        });
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
}
