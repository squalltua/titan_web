<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\View\JsonView;

/**
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index(): \Cake\Http\Response
    {
        $posts = $this->Users->find('all')->all();
        $this->set('posts', $posts);
        $this->viewBuilder()->setOption('serialize', 'posts');

        return $this->render();
    }
}