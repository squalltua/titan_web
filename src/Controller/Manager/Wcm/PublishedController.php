<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;
use Cake\Cache\Cache;
use Cake\I18n\I18n;
use Cake\Routing\Router;

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
        debug($posts);exit;
    }

    public function generate()
    {
        Cache::clear();
        // start generate caching
        Cache::delete('published_posts');
        $posts = Cache::read('published_posts');
        if ($posts === null) {
            $posts = $this->fetchTable('Posts')->getAllPosts();
            $indexPosts = [];
            $lang = I18n::getLocale();
            foreach ($posts as $post) {
                $indexPosts[] = [
                    'title' => $post->title,
                    'link_url' => Router::url("/{$lang}/blogs/{$post->slug}", true),
                ];
            }

            debug($indexPosts);exit;

            // Cache::write('published_posts', $posts);
        }

        debug($posts);
        
        exit;

        $groups = Cache::read('published_groups');
        if ($groups === null)
        {
            $groups = $this->fetchTable('Groups')->getAllGroups();
            // Cache::write('published_groups', $groups);
        }

        $this->Flash->success(__('Published posts and groups have been generated'));

        $this->redirect("/manager/wcm/published");
    }
}