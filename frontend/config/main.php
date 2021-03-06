<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return CMap::mergeArray(require(dirname(__FILE__) . '/../../common/config/main.php'),array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yincart演示购物网',
    'language' => 'zh_cn',
    'theme' => 'default',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'common.components.*',
        'common.extensions.*',
        'common.extensions.ucenter.*',
        'common.models.*',
        'application.models.*',
        'application.components.*',
        'application.components.helpers.*',
        'common.modules.cms.models.*',
        'common.modules.mall.models.*',
        
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'member',
        'cms'=> array(
            'class' => 'common.modules.cms.CmsModule'
            ),
        'user'=> array(
            'class' => 'common.modules.user.UserModule'
            ),
        'mall'=> array(
            'class' => 'common.modules.mall.MallModule'
            ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
            'stateKeyPrefix' => 'front_',
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'rules' => array(
                'page/<key:\w+>' => 'page/index',
                'catalog/<key:\w+>' => 'catalog/index',
                'list/<category_id:\d+>' => 'item/index',
                'item-list-<key:\w+>' => 'item/list',
                'item-<id:\d+>' => 'item/view',
                '<_c:\w+>/<id:\d+>' => '<_c>/view',
                '<_c:\w+>/<_a:\w+>/<id:\d+>' => '<_c>/<_a>',
                '<_c:\w+>/<_a:\w+>' => '<_c>/<_a>',
            ),
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'CFileLogRoute',
//                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
////                    'ipFilters' => array('127.0.0.1', '192.168.0.101'),
//                    'levels' => 'error, warning',
//                ),
//            // uncomment the following to show log messages on web pages
//            /*
//              array(
//              'class'=>'CWebLogRoute',
//              ),
//             */
//            ),
//        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
));