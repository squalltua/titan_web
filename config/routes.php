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

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    /** ==================================================
     *  Front page routes
     * ================================================== */
    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::home');
    });

    $routes->scope('/{lang}', function (RouteBuilder $builder): void {
        // general routes
        $builder->connect('/', 'Pages::home');
        $builder->connect('/about', 'Pages::about');
        $builder->connect('/contact', 'Pages::contact');
        $builder->connect('/privacy-policy', 'Pages::privacyPolicy');
        $builder->connect('/cookies-policy', 'Pages::cookiesPolicy');

        // blogs routes
        $builder->connect('/blogs', 'Pages::allBlogs');
        $builder->connect('/blogs/{slug}', 'Pages::blog')->setPass(['slug']);
        $builder->connect('/blogs/categories/{slug}', 'Pages::categories')->setPass(['slug']);

        // products routes
        $builder->connect('/products', 'Products::index');
        $builder->connect('/products/{slug}', 'Products::view')->setPass(['slug']);
        $builder->connect('/products/categories/{slug}', 'Products::categories')->setPass(['slug']);

        // sandbox routes for preventing 404 error
        $builder->connect('/*', 'Pages::pageNotFoundError');
    });

    /**
     * NOTE: เอาไว้ใช้ในกรณีมีระบบ member และให้ client เข้าใช้งาน
     */
    $routes->prefix('Client', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Client/Clientusers::index');
        $builder->connect('/login', 'Client/Clientusers::login');
        $builder->connect('/logout', 'Client/Clientusers::logout');

        $builder->connect('/setting/{action}/*', ['prefix' => 'Client', 'controller' => 'Settings']);
        $builder->connect('/orders/{action}/*', ['prefix' => 'Client', 'controller' => 'Orders']);

        $builder->connect('/*', 'Pages::pageNotFoundError');
    });

    $routes->scope('/api/v1', function (RouteBuilder $builder): void {
        $builder->scope('/medias', function (RouteBuilder $builder): void {
            $builder->connect('/images/{slug}', 'Api/V1/Medias::getImage')->setPass(['slug']);
        });
    });
    /** ==================================================
     *  END Front page routes
     * ================================================== */

    /** ==================================================
     * Manger routes
     * routes สำหรับระบบหลังบ้านทั้งหมด
     * ================================================== */
    $routes->prefix('Manager', function (RouteBuilder $builder): void {
        $builder->connect('/', 'Pages::index');
        $builder->connect('/login', 'Manager/Settings/Users::login');
        $builder->connect('/logout', 'Manager/Settings/Users::logout');
        $builder->connect('/initialize-data', 'Manager/Settings/Users::initializeData');
        $builder->connect('/reset-data-admin', 'Manager/Settings/Users::resetDataAdmin');

        // สำหรับ Order management (OM)
        $builder->prefix('om', function (RouteBuilder $builder): void {
            $builder->connect('/orders', 'Manager/Om/Orders::index');
            $builder->connect('/orders/add', 'Manager/Om/Orders::add');
            $builder->connect('/orders/view/{id}', 'Manager/Om/Orders::view')->setPass(['id']);
            $builder->connect('/orders/edit/{id}', 'Manager/Om/Orders::edit')->setPass(['id']);
            $builder->connect('/orders/delete/{id}', 'Manager/Om/Orders::delete')->setPass(['id']);
            $builder->connect('/orders/invoices/{id}', 'Manager/Om/Orders::invoices')->setPass(['id']);
        });

        // สำรหรับระบบ Web content management (WCM)
        $builder->prefix('Wcm', function (RouteBuilder $builder): void {
            $builder->connect('/posts', 'Manager/Wcm/Posts::index');
            $builder->connect('/posts/view/{id}', 'Manager/Wcm/Posts::view')->setPass(['id']);
            $builder->connect('/posts/add', 'Manager/Wcm/Posts::add');
            $builder->connect('/posts/edit/{id}', 'Manager/Wcm/Posts::edit')->setPass(['id']);
            $builder->connect('/posts/delete/{id}', 'Manager/Wcm/Posts::delete')->setPass(['id']);
            $builder->connect('/posts/remove-image/{id}', 'Manager/Wcm/Posts::removeImage')->setPass(['id']);

            $builder->connect('/groups', 'Manager/Wcm/Groups::index');
            $builder->connect('/groups/add', 'Manager/Wcm/Groups::add');
            $builder->connect('/groups/edit/{id}', 'Manager/Wcm/Groups::edit')->setPass(['id']);
            $builder->connect('/groups/delete/{id}', 'Manager/Wcm/Groups::delete')->setPass(['id']);

            $builder->connect('/published', 'Manager/Wcm/Published::index');
            $builder->connect('/published/generate', 'Manager/Wcm/Published::generate');
        });
        
        // สำหรับ Product information management (PIM)
        $builder->prefix('Pim', function (RouteBuilder $builder): void {
            $builder->connect('/products', 'Manager/Pim/Products::index');
            $builder->connect('/products/add', 'Manager/Pim/Products::add');
            $builder->connect('/products/detail/{id}', 'Manager/Pim/Products::detail')->setPass(['id']);
            $builder->connect('/products/edit/{id}', 'Manager/Pim/Products::edit')->setPass(['id']);
            $builder->connect('/products/delete/{id}', 'Manager/Pim/Products::delete')->setPass(['id']);

            $builder->connect('/products/meta/{id}', 'Manager/Pim/Products::meta')->setPass(['id']);
            $builder->connect('/products/meta-add/{id}', 'Manager/Pim/Products::metaAdd')->setPass(['id']);
            $builder->connect('/products/meta-edit/{product_id}/{meta_id}', 'Manager/Pim/Products::metaEdit')->setPass(['product_id', 'meta_id']);
            $builder->connect('/products/meta-delete/{product_id}/{meta_id}', 'Manager/Pim/Products::metaDelete')->setPass(['product_id', 'meta_id']);

            $builder->connect('/products/images/{id}', 'Manager/Pim/Products::images')->setPass(['id']);
            $builder->connect('/products/remove-image/{product_id}/{media_id}', 'Manager/Pim/Products::removeImage')->setPass(['product_id', 'media_id']);

            $builder->connect('/products/variants/{id}', 'Manager/Pim/Products::variants')->setPass(['id']);
            $builder->connect('/products/variant-add/{id}', 'Manager/Pim/Products::variantAdd')->setPass(['id']);
            $builder->connect('/products/variant-edit/{product_id}/{variant_id}', 'Manager/Pim/Products::variantEdit')->setPass(['product_id', 'variant_id']);
            $builder->connect('/products/variant-delete/{product_id}/{variant_id}', 'Manager/Pim/Products::variantDelete')->setPass(['product_id', 'variant_id']);
            $builder->connect('/products/variant-option-add/{product_id}/{variant_id}', 'Manager/Pim/Products::variantOptionAdd')->setPass(['product_id', 'variant_id']);
            $builder->connect('/products/variant-option-delete/{product_id}/{variant_id}/{option_id}', 'Manager/Pim/Products::variantOptionDelete')->setPass(['product_id', 'variant_id', 'option_id']);

            $builder->connect('/categories', ['prefix' => 'Manager/Pim', 'controller' => 'Categories', 'action' => 'index']);
            $builder->connect('/categories/add', 'Manager/Pim/Categories::add');
            $builder->connect('/categories/edit/{id}', 'Manager/Pim/Categories::edit')->setPass(['id']);
            $builder->connect('/categories/delete/{id}', 'Manager/Pim/Categories::delete')->setPass(['id']);

            $builder->connect('/variant-options', ['prefix' => 'Manager/Pim', 'controller' => 'VariantOptions', 'action' => 'index']);
            $builder->connect('/variant-options/add', 'Manager/Pim/VariantOptions::add');
            $builder->connect('/variant-options/edit/{id}', 'Manager/Pim/VariantOptions::edit')->setPass(['id']);
            $builder->connect('/variant-options/delete/{id}', 'Manager/Pim/VariantOptions::delete')->setPass(['id']);
            $builder->connect('/variant-options/option-add/{attribute_id}', 'Manager/Pim/VariantOptions::optionAdd')->setPass(['attribute_id']);
            $builder->connect('/variant-options/option-edit/{attribute_id}/{option_id}', 'Manager/Pim/VariantOptions::optionEdit')->setPass(['attribute_id', 'option_id']);
            $builder->connect('/variant-options/option-delete/{attribute_id}/{option_id}', 'Manager/Pim/VariantOptions::optionDelete')->setPass(['attribute_id', 'option_id']);

            $builder->connect('/published', 'Manager/Pim/Published::index');
            $builder->connect('/published/generate', 'Manager/Pim/Published::generate');
        });

        // สำหรับ Digital assets management (DAM)
        $builder->prefix('Dam', function (RouteBuilder $builder): void {
            $builder->connect('/medias', 'Manager/Dam/Medias::index');
            $builder->connect('/medias/add', 'Manager/Dam/Medias::add');
            $builder->connect('/medias/edit/{id}', 'Manager/Dam/Medias::edit')->setPass(['id']);
            $builder->connect('/medias/delete/{id}', 'Manager/Dam/Medias::delete')->setPass(['id']);
        });

        // สำหรับ Settings ของระบบ
        $builder->prefix('Settings', function (RouteBuilder $builder): void {
            $builder->connect('/system', 'Manager/Settings/SystemSettings::system');

            $builder->connect('/admin-users', 'Manager/Settings/AdminUsers::index');
            $builder->connect('/admin-users/add', 'Manager/Settings/AdminUsers::add');
            $builder->connect('/admin-users/edit/{id}', 'Manager/Settings/AdminUsers::edit')->setPass(['id']);
            $builder->connect('/admin-users/delete/{id}', 'Manager/Settings/AdminUsers::delete')->setPass(['id']);

            $builder->connect('/roles', 'Manager/Settings/Roles::index');
            $builder->connect('/roles/add', 'Manager/Settings/Roles::add');
            $builder->connect('/roles/edit/{id}', 'Manager/Settings/Roles::edit')->setPass(['id']);
            $builder->connect('/roles/delete/{id}', 'Manager/Settings/Roles::delete')->setPass(['id']);

            $builder->connect('/languages', 'Manager/Settings/Languages::index');
            $builder->connect('/languages/add', 'Manager/Settings/Languages::add');
            $builder->connect('/languages/edit/{id}', 'Manager/Settings/Languages::edit')->setPass(['id']);
            $builder->connect('/languages/delete/{id}', 'Manager/Settings/Languages::delete')->setPass(['id']);

            $builder->connect('/published', 'Manager/Settings/Published::index');
            $builder->connect('/published/generate', 'Manager/Settings/Published::generate');
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
            $builder->connect('/variant-attributes/get-option-list', 'Manager/Api/v1/VariantAttributes::getOptionList');

            $builder->resources('Medias', ['prefix' => 'Api/V1']);
        });

        $builder->connect('/*', 'Manager/Pages::pageNotFoundError');
    });

    /** ==================================================
     *  END Manager routes
     * ================================================== */
};