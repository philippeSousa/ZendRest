<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
						'__NAMESPACE__' => 'Restapi\Controller',
						'controller'    => 'Restapi\Controller\Admin',
                        'action'     => 'home',
                    ),
                ),
            ),
    		'admin' => array(
    				'type'    => 'Literal',
    				'options' => array(
    						'route'    => '/admin',
    						'defaults' => array(
    								'__NAMESPACE__' => 'Restapi\Controller',
    								'controller'    => 'Restapi\Controller\Admin',
    								'action'        => 'index',
    						),
    				),
    				'may_terminate' => true
    		),
    		'api' => array(
        		    'type'    => 'Literal',
        		    'options' => array(
        		        'route'    => '/api/country',
        		        'defaults' => array(
        		    								'__NAMESPACE__' => 'Restapi\Controller',
        		    								'controller'    => 'Restapi\Controller\Api',
        		    								'action'        => 'index',
        		        ),
        		    ),
        		    'may_terminate' => true,
        		    'child_routes' => array(
        		        'country' => array(
    		    								'type'    => 'Segment',
    		    								'options' => array(
    		    								    'route'    => '/[:iso3166]',
    		    								    'constraints' => array(
    		    								    ),
    		    								    'defaults' => array(
            		    								'__NAMESPACE__' => 'Restapi\Controller',
            		    								'controller'    => 'Restapi\Controller\Api',
            		    								'action'        => 'singleRecord',
    		    								    ),
    		    								),
        		    'may_terminate' => true,
    		        ),
    		    ),
    		),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Restapi\Controller\Api' => 'Restapi\Controller\ApiController',
        	'Restapi\Controller\Admin' => 'Restapi\Controller\AdminController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
