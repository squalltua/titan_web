<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;
use Cake\Cache\Cache;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use Cake\Utility\Hash;

class PublishedController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('applicationName', __('Site setting and System'));
        $this->set('subMenuActive', 'published');
    }

    /**
     * index functiton
     *
     * @return void
     */
    public function index()
    {
        $counter = [];
        $languages = $this->fetchTable('Languages')->getTabList();
        foreach ($languages as $unicode => $localeText) {
            $cache = Cache::read("{$unicode}_site_settings", 'settings');
            $counter[$unicode] = $cache ? count($cache) : 0;
        }

        $this->set(compact('counter'));
    }

    /**
     * Generate cache data function
     *
     * @return  null|Response
     */
    public function generate()
    {
        if ($this->request->getQuery('clear_all')) {
            Cache::clear();
        }
        
        // load languages
        $languages = $this->fetchTable('Languages')->getTabList();

        // write cache
        Cache::write('languages', $languages);
        Cache::write('language_default', $this->fetchTable('Languages')->getDefaultLanguageUnicode());

        $this->_cachingSettingSystem();
        // end write cache

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/settings/published");
    }

    /**
     * create system cache
     *
     * @return void
     */
    private function _cachingSettingSystem(): void
    {
        $settings = $this->fetchTable('SiteSettings')->getSiteSettingAllLanguages();
        $defaultLocale = $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $siteSetting = [];
        foreach ($settings as $setting) {
            $siteSetting[$defaultLocale][$setting->key_field] = $setting->value_field;
            if (!empty($setting->_translations)) {
                foreach ($setting->_translations as $locale => $data) {
                    $siteSetting[$locale][$setting->key_field] = $data->value_field;
                }
            }
        }

        foreach ($siteSetting as $locale => $data) {
            Cache::write("{$locale}_site_settings", $data, 'settings');
        }
    }
}
