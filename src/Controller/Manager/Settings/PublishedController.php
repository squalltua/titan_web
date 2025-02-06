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

    public function index()
    {
        $counter = [];
        $languages = $this->fetchTable('Languages')->getTabList();
        foreach ($languages as $unicode => $localeText) {
            $cache = Cache::read("{$unicode}_site_settings");
            $counter[$unicode] = $cache ? count($cache) : 0;
        }

        $langCount = count($counter);

        $this->set(compact('counter', 'langCount'));
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

        $this->_cachingSettingSystem($languages);
        // end write cache

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/settings/published");
    }

    /**
     * create system cache
     *
     * @param array $languages language all data
     * @return void
     */
    private function _cachingSettingSystem(array $languages): void
    {
        // load SiteSettings
        $settings = $this->fetchTable('SiteSettings')->getSiteSettingAllLanguages();
        // debug($settings);
        $data = [];
        $first = true;
        foreach ($languages as $unicode => $title) {
            if ($first) {
                Cache::write("{$unicode}_site_settings", Hash::combine($settings->toArray(), '{n}.key_field', '{n}.value_field'));
            } else {
                foreach ($settings as $setting) {
                    $data[] = ['key_field' => $setting->key_field, 'value_field' => $setting->translation($unicode)->value_field];
                }

                Cache::write("{$unicode}_site_settings", Hash::combine($data, '{n}.key_field', '{n}.value_field'));
            }

            $first = false;
        }
    }
}
