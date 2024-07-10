<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\View\JsonView;

/**
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index(): \Cake\Http\Response
    {
        $posts = $this->Posts->find('all')->all();
        $this->set('posts', $posts);
        $this->viewBuilder()->setOption('serialize', 'posts');

        return $this->render();
    }
}