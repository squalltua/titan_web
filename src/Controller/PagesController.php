<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\I18n\I18n;
use Cake\Utility\Text;
use Cake\Utility\Hash;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function beforeRender(\Cake\Event\EventInterface $event): void
    {
        $this->viewBuilder()->setTheme('DefaultTheme');        
    }

    public function initialize(): void
    {
        parent::initialize();

        /**
         * ---------------- NOTE ----------------
         * การโหลดข้อมูลต่างๆ แนะนำให้โหลดผ่าน Cache
         * 
         * ---------------- END  ----------------
         */

        // load language form cache
        $languages = Cache::read('languages') ?: ['en' => 'English'];
        $lang = $this->request->getParam('lang');
        if (empty($languages[$lang])) {
            $lang = Cache::read('language_default') ?: Configure::read('App.defaultLocale');
            $this->changeLanguage($lang);
        }

        I18n::setLocale($lang);
        $this->set('lang', $lang);
        
        $siteSetting = Cache::read("{$lang}_site_settings");
        $this->set(compact('siteSetting'));
    }

    public function changeLanguage(string $lang): Response
    {
        return $this->redirect("/{$lang}");
    }

    public function home(): Response
    {
        return $this->render();
    }

    public function about(): Response
    {
        return $this->render();
    }

    public function services(string $pageName): Response
    {
        $pageName = strtolower(Text::slug($pageName, '_'));

        return $this->render("services/{$pageName}");
    }

    public function industries(string $pageName): Response
    {
        $pageName = strtolower(Text::slug($pageName, '_'));

        return $this->render("industries/{$pageName}");
    }

    public function products(string $pageName): Response
    {
        $pageName = strtolower(Text::slug($pageName, '_'));

        return $this->render("products/{$pageName}");
    }

    public function contact(): Response
    {
        return $this->render();
    }

    public function policy(string $pageName)
    {
        $pageName = strtolower(Text::slug($pageName, '_'));

        return $this->render("policy/{$pageName}");
    }

    public function privacyPolicy(): Response
    {
        return $this->render();
    }

    public function cookiesPolicy(): Response
    {
        return $this->render();
    }

    public function allBlogs()
    {
        $lang = $this->request->getParam('lang');
        $blogs = Cache::read("{$lang}_published_posts_indexes");

        $this->set(compact('blogs'));
    }

    public function blog(string $slug)
    {
        $lang = $this->request->getParam('lang');
        $cacheName = "{$lang}-{$slug}";
        $blog = Cache::read($cacheName);

        $this->set(compact('blog'));
    }

    public function pageNotFoundError(): Response
    {
        $this->viewBuilder()->setLayout('error');

        return $this->render();
    }
}
