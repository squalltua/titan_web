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

        $lang = $this->request->getParam('lang');
        if (!$lang) {
            $lang = strtolower(Text::slug(Configure::read('App.defaultLocale')));
            if (!in_array($lang, ['th', 'en', 'jp'])) {
                $lang = 'th';
            }
            $this->changeLanguage($lang);
        } else {
            if (!in_array($lang, ['th', 'en', 'jp'])) {
                $this->changeLanguage('th');
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

    public function changeLanguage(string $lang = 'th'): Response
    {
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
