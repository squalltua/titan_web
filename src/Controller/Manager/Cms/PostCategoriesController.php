<?php

namespace App\Controller\Manager;

use App\Controller\Manager\AppController;

class PostCategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'post-categories');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
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

                return $this->redirect('/manager/posts/categories');
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

                return $this->redirect('/manager/posts/categories');
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
            return $this->redirect('/manager/post-tags');
        }

        $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        return $this->redirect("/manager/posts/categories/edit/{$id}");
    }
}