<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

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

        $this->set('menuActive', 'pim');
        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'published');
    }
    public function index()
    {
        $counter = [];
        $languages = $this->fetchTable('Languages')->getTabList();
        foreach ($languages as $unicode => $localeText) {
            $cache = Cache::read("{$unicode}_published_products_indexes");
            $counter[$unicode] = $cache ? count($cache) : 0;
        }

        $this->set(compact('counter'));
    }

    public function generate()
    {
        if ($this->request->getQuery('clear_all')) {
            Cache::clear();
        }
        
        $languages = $this->fetchTable('Languages')->getTabList();
        $defaultLanguage = $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $this->_cachingCategories($languages, $defaultLanguage);
        $this->_cachingProducts($languages, $defaultLanguage);

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/wcm/published");
    }

    private function _cachingCategories(array $languages, string $defaultLanguage): void
    {

    }

    private function _cachingProducts(array $languages, string $defaultLanguage): void
    {
        // load all products data
        $posts = $this->fetchTable('Products')->find('translations')
            ->where(['status' => 'published'])
            ->contain('MetaPosts', function ($q) {
                return $q->find('translations');
            })
            ->contain('Categories', function ($q) {
                return $q->find('translations');
            })
            ->contain('Variants', function ($q) {
                return $q->find('translations')->contain(['AttributeOptions', 'AttributeOptions.Attributes', 'VariantMedias']);
            });

        debug($posts->toArray());
    }
}
