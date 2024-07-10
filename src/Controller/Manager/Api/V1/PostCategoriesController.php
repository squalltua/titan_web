<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\View\JsonView;

/**
 * @property \App\Model\Table\PostGroupsTable $PostGroups
 */
class PostCategoriesController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index(): \Cake\Http\Response
    {
        $categories = $this->PostGroups->getCategories();
        $this->set('categories', $categories);
        $this->viewBuilder()->setOption('serialize', 'categories');

        return $this->render();
    }
}