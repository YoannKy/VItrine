<?php

use Acl\Listener\Acl as AclListener;
use Acl\Service\Acl as AclService;
use Zend\Permissions\Acl\Acl;

return array(
    'service_manager' => array(
            'factories' => array(
                'AclListener' =>'Acl\Factory\AclListenerFactory',
            'AclService' => 'Acl\Factory\AclServiceFactory'
        )
    ),
);