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

    $routes->prefix('Manager', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::index');
        $builder->connect('/login', 'Users::login');
        $builder->connect('/logout', 'Users::logout');
        $builder->connect('/initialize-data', 'Users::initializeData');

        $builder->prefix('Cms', function (RouteBuilder $builder): void {
            $builder->connect('/', ['prefix' => 'Manager/Cms', 'controller' => 'Cms', 'action' => 'dashboard']);

            $builder->connect('/posts', ['prefix' => 'Manager/Cms', 'controller' => 'Posts', 'action' => 'index']);
            $builder->connect('/posts/{action}/*', ['prefix' => 'Manager/Cms', 'controller' => 'Posts']);

            $builder->connect('/categories', ['prefix' => 'Manager/Cms', 'controller' => 'PostCategories', 'action' => 'index']);
            $builder->connect('/categories/{action}/*', ['prefix' => 'Manager/Cms', 'controller', 'PostCategories']);

            $builder->connect('/tags', ['prefix' => 'Manager/Cms', 'controller' => 'PostTags', 'action' => 'index']);
            $builder->connect('/tags/{action}/*', ['prefix' => 'Manager/Cms', 'controller' => 'PostTags']);
        });

        $builder->prefix('Settings', function (RouteBuilder $builder): void {
            $builder->connect('/system', 'Settings::system');

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
};
