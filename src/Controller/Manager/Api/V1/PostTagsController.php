<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\View\JsonView;

/**
 * @property \App\Model\Table\PostGroupsTable $PostGroups
 */
class PostTagsController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index(): \Cake\Http\Response
    {
        $tags = $this->PostGroups->getTags();
        $this->set('tags', $tags);
        $this->viewBuilder()->setOption('serialize', 'tags');

        return $this->render();
    }
}