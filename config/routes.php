<?php
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
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        $builder->connect('/*', 'Pages::pageNotFoundError');
        $builder->fallbacks();
    });

    $routes->prefix('Manager', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::index');
        $builder->connect('/login', 'Users::login');
        $builder->connect('/logout', 'Users::logout');
        $builder->connect('/init-user', 'Users::initUser');

        $builder->scope('/articles', function (RouteBuilder $builder): void {
            $builder->connect('/', 'Articles::index');
            $builder->connect('/edit/{id}', 'Articles::edit')->setPass(['id']);
            $builder->connect('/delete/{id}', 'Articles::delete')->setPass(['id']);
        });

        $builder->scope('/settings', function (RouteBuilder $builder): void {
            $builder->connect('/', 'Settings::index');
        });

        $builder->connect('/*', 'Pages::pageNotFoundError');
        $builder->fallbacks();
    });

    /**
     * API routes
     */
    $routes->scope('/api', function (RouteBuilder $builder): void {
        // No $builder->applyMiddleware() here.
        // Parse specified extensions from URLs
        // $builder->setExtensions(['json', 'xml']);
        // Connect API actions here.
    });
};
