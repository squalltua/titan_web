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
        // just page
        $posts = Cache::read('published_posts');
        debug($posts);
        exit;
    }

    public function generate()
    {
        Cache::clear();
        // start generate caching
        Cache::delete('published_posts');
        $posts = Cache::read('published_posts');
        $languages = $this->fetchTable('Languages')->getTabList();
        $defaultLanguage = $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        if ($posts === null) {
            // $posts = $this->fetchTable('Posts')->getAllPosts();
            $posts = $this->fetchTable('Posts')->find('translations')
                ->where(['status' => 'published'])
                ->contain('MetaPosts', function ($q) {
                    return $q->find('translations');
                })
                ->contain(['Groups']);

            $indexPosts = [];
            foreach ($posts as $post) {
                $meta = Hash::combine($post->meta_posts, '{n}.meta_key', '{n}');
                $isFirst = true;
                foreach ($languages as $unicode => $langNotUsed) {
                    if ($isFirst) {
                        $isFirst = false;
                        $indexPosts[] = [
                            'title' => $post->title,
                            'intro' => $post->intro,
                            'link_url' => Router::url("/{$defaultLanguage}/blogs/{$post->slug}", true),
                            'feature_image_url' => $meta['feature_image']->meta_value,
                            'og_tag_title' => $meta['og_tag_title']->meta_value,
                        ];
                        $isFirst = false;
                    } else {
                        $indexPosts[] = [
                            'title' => $post->_translations[$unicode]->title,
                            'intro' => $post->_translations[$unicode]->intro,
                            'link_url' => Router::url("/{$unicode}/blogs/{$post->_translations[$unicode]->slug}", true),
                            'feature_image_url' => $meta['feature_image']->_translations[$unicode]->meta_value ?? $meta['feature_image']->meta_value,
                            'og_tag_title' => $meta['og_tag_title']->_translations[$unicode]->meta_value ?? $meta['og_tag_title']->meta_value,
                        ];
                    }
                }
            }

            debug($indexPosts);
            exit;

            // Cache::write('published_posts', $posts);
        }

        debug($posts);

        exit;

        $groups = Cache::read('published_groups');
        if ($groups === null) {
            $groups = $this->fetchTable('Groups')->getAllGroups();
            // Cache::write('published_groups', $groups);
        }

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/wcm/published");
    }
}
