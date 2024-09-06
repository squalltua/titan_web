<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cms;

use App\Controller\Manager\AppController;
use Cake\Http\Exception\NotFoundException;

class PostCategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cms_menu');
        $this->set('subMenuActive', 'categories');
        $this->set('applicationName', __('Content management system'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        try {
            $categories = $this->paginate($this->fetchTable('PostGroups')->getCategoriesAll());
        } catch (NotFoundException $e) {
            // Do something here like redirecting to first or last page.
            // $e->getPrevious()->getAttributes('pagingParams') will give you required info.
        }

        $this->set(compact('categories'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $category = $this->fetchTable('PostGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->fetchTable('PostGroups')->patchEntity($category, $this->request->getData());
            $category->type = 'categories';
            if ($this->fetchTable('PostGroups')->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect('/manager/cms/categories');
            }

            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set(compact('category'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $category = $this->fetchTable('PostGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->fetchTable('PostGroups')->patchEntity($category, $this->request->getData());
            if ($this->fetchTable('PostGroups')->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect('/manager/cms/categories');
            }

            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set(compact('category'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->fetchTable('PostGroups')->get($id);
        if ($this->fetchTable('PostGroups')->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
            return $this->redirect('/manager/cms/categories');
        }

        $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        return $this->redirect("/manager/cms/categories/edit/{$id}");
    }
}
