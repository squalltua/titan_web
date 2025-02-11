<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

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

        $this->set('subMenu', 'wcm_menu');
        $this->set('subMenuActive', 'published');
        $this->set('applicationName', __('Web content management'));
    }
    public function index()
    {
        $counter = [];
        $languages = $this->fetchTable('Languages')->getTabList();
        foreach ($languages as $unicode => $localeText) {
            $cache = Cache::read("{$unicode}_published_posts_indexes");
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

        $this->_cachingPosts($languages, $defaultLanguage);
        $this->_cachingGroups($languages, $defaultLanguage);

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/wcm/published");
    }

    private function _cachingPosts(array $languages, string $defaultLanguage): void
    {
        // Cache::clear();
        // Load all Post data.
        $posts = $this->fetchTable('Posts')->find('translations')
            ->where(['status' => 'published'])
            ->contain('MetaPosts', function ($q) {
                return $q->find('translations');
            })
            ->contain(['Groups']);

        // Create index for searching and datalist
        $indexPosts = [];
        foreach ($posts as $post) {
            $meta = Hash::combine($post->meta_posts, '{n}.meta_key', '{n}');
            $isFirst = true;
            foreach ($languages as $unicode => $langNotUsed) {
                if ($isFirst) {
                    $isFirst = false;
                    $indexPosts[$unicode][] = [
                        'title' => $post->title,
                        'intro' => $post->intro,
                        'link_url' => Router::url("/{$defaultLanguage}/blogs/{$post->slug}", true),
                        'feature_image_url' => $meta['feature_image']->meta_value ?? null,
                    ];

                    Cache::write("{$unicode}-{$post->slug}", $post);

                    $isFirst = false;
                } else {
                    $indexPosts[$unicode][] = [
                        'title' => $post->_translations[$unicode]->title,
                        'intro' => $post->_translations[$unicode]->intro,
                        'link_url' => Router::url("/{$unicode}/blogs/{$post->_translations[$unicode]->slug}", true),
                        'feature_image_url' => $meta['feature_image']->_translations[$unicode]->meta_value ?? $meta['feature_image']->meta_value ?? null,
                    ];

                    Cache::write("{$unicode}-{$post->_translations[$unicode]->slug}", $post->_translations[$unicode]);
                }
            }
        }

        foreach ($indexPosts as $locale => $posts) {
            Cache::write("{$locale}_published_posts_indexes", $posts);
        }
    }

    private function _cachingGroups(array $languages, string $defaultLanguages)
    {
        Cache::delete('published_groups_indexes');
    }
}
