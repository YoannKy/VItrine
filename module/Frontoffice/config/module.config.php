<?php
namespace Frontoffice;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'fo-product' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/category/:id_category/product[/:action][/:id]',
                    'constraints' => array(
                        'id_category' => '[0-9]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'frontoffice-product',
                        'action'     => 'index',
                    ),
                ),
            ),
            'fo-category' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/category[/:page]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                        'page'     => '[0-9]+',    
                    ),
                    'defaults' => array(
                        'controller' => 'frontoffice-category',
                        'action' => 'index'
                    )
                )
            ),
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'frontoffice-product',
                        'action' => 'last'
                    )
                )
            ),
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator'
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'frontoffice-product' => 'Frontoffice\Factory\ProductControllerFactory',
            'frontoffice-category' => 'Frontoffice\Factory\CategoryControllerFactory',
        ),
    ),
//     'view_helpers' => array(
//         'invokables'=> array(
//             'PaginationHelper' => 'Application\Helper\PaginationHelper')
//     ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/front_layout'     => __DIR__ . '/../view/layout/layout.phtml',
            'frontoffice/index/index' => __DIR__ . '/../view/frontoffice/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/front_404.phtml',
            'error/front_index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'Application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../../Application/src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'Application_driver'
                )
            )
        )
    )
);
