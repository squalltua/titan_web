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
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);

        $builder->connect('/*', 'Pages::pageNotFoundError');
        // $builder->fallbacks();
    });

    $routes->prefix('Manager', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::index');
        $builder->connect('/login', 'Users::login');
        $builder->connect('/logout', 'Users::logout');
        $builder->connect('/initialize-data', 'Users::initializeData');

        $builder->scope('/posts', function (RouteBuilder $builder): void {
            $builder->connect('/', 'Posts::index');
            $builder->connect('/add', 'Posts::add');
            $builder->connect('/edit/{id}', 'Posts::edit')->setPass(['id']);
            $builder->connect('/delete/{id}', 'Posts::delete')->setPass(['id']);

            $builder->connect('/categories', 'PostCategories::index');
            $builder->connect('/categories/add', 'PostCategories::add');
            $builder->connect('/categories/edit/{id}', 'PostCategories::edit')->setPass(['id']);
            $builder->connect('/categories/delete/{id}', 'PostCategories::delete')->setPass(['id']);

            $builder->connect('/tags', 'PostTags::index');
            $builder->connect('/tags/add', 'PostTags::add');
            $builder->connect('/tags/edit/{id}', 'PostTags::edit')->setPass(['id']);
            $builder->connect('/tags/delete/{id}', 'PostTags::delete')->setPass(['id']);
        });

        $builder->scope('/settings', function (RouteBuilder $builder): void {
            $builder->connect('/system', 'Settings::system');
        });

        $builder->scope('/users', function (RouteBuilder $builder): void {
            $builder->connect('/', 'Users::index');
            $builder->connect('/add', 'Users::add');
            $builder->connect('/edit/{id}', 'Users::edit')->setPass(['id']);
            $builder->connect('/delete/{id}', 'Users::delete')->setPass(['id']);
            $builder->connect('/change-password/{id}', 'Users::changePassword')->setPass(['id']);
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
        });

        $builder->connect('/*', 'Pages::pageNotFoundError');
        // $builder->fallbacks();
    });
};
