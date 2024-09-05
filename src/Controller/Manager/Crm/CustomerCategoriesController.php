<?php

declare(strict_types=1);

namespace App\Controller\Manager\Crm;

use App\Controller\Manager\AppController;

class CustomerCategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'crm_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Customer relationship managment'));
    }

    public function index()
    {
        $categories = $this->paginate($this->fetchTable('CustomerGroups'));

        $this->set(compact('categories'));
    }

    public function add()
    {
        $category = $this->fetchTable('CustomerGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->fetchTable('CustomerGroups')->patchEntity($category, $this->request->getData());
            $category->type = 'categories';
            if ($this->fetchTable('CustomerGroups')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/crm/categories');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function edit(string $id)
    {
        $category = $this->fetchTable('CustomerGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->fetchTable('CustomerGroups')->patchEntity($category, $this->request->getData());
            if ($this->fetchTable('CustomerGroups')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/crm/categories/edit/{$id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $category = $this->fetchTable('CustomerGroups')->get($id);
        if ($this->fetchTable('CustomerGroups')->delete($category)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/crm/categories');
    }
}
