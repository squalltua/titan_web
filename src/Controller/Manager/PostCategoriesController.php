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
        $tag = $this->fetchTable('PostGroup')->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->fetchTable('PostGroup')->patchEntity($tag, $this->request->getData());
            $tag->type = 'categories';
            if ($this->fetchTable('PostGroup')->save($tag)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect('/manager/categories/tags');
            }

            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $tag = $this->fetchTable('PostGroup')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $tag = $this->fetchTable('PostGroup')->patchEntity($tag, $this->request->getData());
            if ($this->fetchTable('PostGroup')->save($tag)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect('/manager/categories/tags');
            }

            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->fetchTable('PostGroup')->get($id);
        if ($this->fetchTable('PostGroup')->delete($tag)) {
            $this->Flash->success(__('The category has been deleted.'));
            return $this->redirect('/manager/post-tags');
        }

        $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        return $this->redirect("/manager/posts/categories/edit/{$id}");
    }
}