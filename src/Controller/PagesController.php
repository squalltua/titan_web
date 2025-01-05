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

        $langSets = $this->fetchTable('Languages')->find('list', keyField: 'unicode', valueField: 'title')->toArray();
        $langSets = $langSets ?: ['en' => 'English'];
        $lang = $this->request->getParam('lang');
        if (!$lang) {
            // Setup default language and reload page
            $lang = $this->fetchTable('Languages')->getDefaultLanguageUnicode() ?: Configure::read('App.defaultLocale');
            $this->changeLanguage($lang);
        } else {
            // Setup language
            if (!isset($langSets[$lang])) {
                $this->changeLanguage(Configure::read('App.defaultLocale'));
            }
            I18n::setLocale($lang);
        }
        $this->set('lang', $lang);
    }

    public function initialize(): void
    {
        parent::initialize();

        $siteSettingData = $this->fetchTable('SiteSettings')->find('all');
        $siteSetting = Hash::combine($siteSettingData->toArray(), '{n}.key_field', '{n}.value_field');

        $this->set(compact('siteSetting'));
    }

    public function changeLanguage(?string $lang): Response
    {
        $lang = $lang ?: Configure::read('App.defaultLocale');
        I18n::setLocale($lang);
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

    public function pageNotFoundError(): Response
    {
        $this->viewBuilder()->setLayout('error');

        return $this->render();
    }
}
