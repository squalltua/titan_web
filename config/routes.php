<?php

declare(strict_types=1);

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */

return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);

        $builder->connect('/*', 'Pages::pageNotFoundError');
        // $builder->fallbacks();
    });

    $routes->prefix('Client', function (RouteBuilder $builder): void  {
        $builder->connect('/', 'Client/Clientusers::index');
        $builder->connect('/login', 'Client/Clientusers::login');
        $builder->connect('/logout', 'Client/Clientusers::logout');

        $builder->connect('/setting/{action}/*', ['prefix' => 'Client', 'controller' => 'Settings']);
        $builder->connect('/orders/{action}/*', ['prefix' => 'Client', 'controller' => 'Orders']);

        $builder->connect('/*', 'Pages::pageNotFoundError');
    });

    $routes->prefix('Manager', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::index');
        $builder->connect('/login', 'Manager/Settings/Users::login');
        $builder->connect('/logout', 'Manager/Settings/Users::logout');
        $builder->connect('/initialize-data', 'Manager/Settings/Users::initializeData');

        $builder->prefix('Cms', function (RouteBuilder $builder): void {
            $builder->connect('/', ['prefix' => 'Manager/Cms', 'controller' => 'Pages', 'action' => 'dashboard']);

            $builder->connect('/posts', ['prefix' => 'Manager/Cms', 'controller' => 'Posts', 'action' => 'index']);
            $builder->connect('/posts/{action}/*', ['prefix' => 'Manager/Cms', 'controller' => 'Posts']);

            $builder->connect('/groups', ['prefix' => 'Manager/Cms', 'controller' => 'PostGroups', 'action' => 'index']);
            $builder->connect('/groups/{action}/*', ['prefix' => 'Manager/Cms', 'controller'=> 'PostGroups']);
        });

        $builder->prefix('Pim', function (RouteBuilder $builder): void {
            $builder->connect('/', ['prefix' => 'Manager/Pim', 'controller' => 'Pages', 'action' => 'dashboard']);

            $builder->connect('/products', ['prefix' => 'Manager/Pim', 'controller' => 'Products', 'action' => 'index']);
            $builder->connect('/products/{action}/*', ['prefix' => 'Manager/Pim', 'controller' => 'Products']);

            $builder->connect('/groups', ['prefix' => 'Manager/Pim', 'controller' => 'ProductGroups', 'action' => 'index']);
            $builder->connect('/groups/{action}/*', ['prefix' => 'Manager/Pim', 'controller' => 'ProductGroups']);
        });

        $builder->prefix('Dam', function (RouteBuilder $builder): void {
            $builder->connect('/', ['prefix' => 'Manager/Dam', 'controller' => 'Pages', 'action' => 'dashboard']);

            $builder->connect('/medias', ['prefix' => 'Manager/Dam', 'controller' => 'Medias', 'action' => 'index']);
            $builder->connect('/medias/{action}/*', ['prefix' => 'Manager/Dam', 'controller' => 'Medias']);
        });

        $builder->prefix('Crm', function (RouteBuilder $builder): void {
            $builder->connect('/', ['prefix' => 'Manager/Crm', 'controller' => 'Pages', 'action' => 'dashboard']);

            $builder->connect('/customers', ['prefix' => 'Manager/Crm', 'controller' => 'Customers', 'action' => 'inddex']);
            $builder->connect('/customers/{action}/*', ['prefix' => 'Manager/Crm', 'controller' => 'Customers']);

            $builder->connect('/groups', ['prefix' => 'Manager/Crm', 'controller' => 'CustomerGroups', 'action' => 'index']);
            $builder->connect('/groups/{action}/*', ['prefix' => 'Manager/Crm', 'controller' => 'CustomerGroups']);
        });

        $builder->prefix('Settings', function (RouteBuilder $builder): void {
            $builder->connect('/system', 'SystemSettings::system');

            $builder->connect('/users', ['prefix', 'Manager/Settings', 'controller' => 'Users', 'action' => 'index']);
            $builder->connect('/users/{action}/*', ['prefix' => 'Manager/Settings', 'controller' => 'Users']);
        });

        /**
         * API routes
         */
        $builder->scope('/api/v1', function (RouteBuilder $builder): void {
            // No $builder->applyMiddleware() here.
            // Parse specified extensions from URLs
            $builder->setExtensions(['json']);
            // Connect API actions here.
            $builder->connect('/users', 'Manager/Api/v1/Users::index');
            $builder->connect('/posts', 'Manager/Api/v1/Posts::index');
            $builder->connect('/post-tags', 'Manager/Api/v1/PostTags::index');
            $builder->connect('/post-categories', 'Manager/Api/v1/PostCategories::index');

            $builder->resources('Medias', ['prefix' => 'Api/V1']);
        });

        $builder->connect('/*', 'Pages::pageNotFoundError');
        // $builder->fallbacks();
    });

    $routes->scope('/api/v1', function (RouteBuilder $builder): void {
        $builder->scope('/medias', function (RouteBuilder $builder): void {
            $builder->connect('/images/{slug}', 'Api/V1/Medias::getImage')->setPass(['slug']);
        });
    });
};
