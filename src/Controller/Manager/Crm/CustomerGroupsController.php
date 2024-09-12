<?php

declare(strict_types=1);

namespace App\Controller\Manager\Crm;

use App\Controller\Manager\AppController;

class CustomerGroupsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'crm_menu');
        $this->set('subMenuActive', 'groups');
        $this->set('applicationName', __('Customer relationship managment'));
    }

    public function index()
    {
        $groups = $this->paginate($this->CustomerGroups);

        $this->set(compact('groups'));
    }

    public function add()
    {
        $category = $this->CustomerGroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->CustomerGroups->patchEntity($category, $this->request->getData());
            $category->type = 'groups';
            if ($this->CustomerGroups->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/crm/groups');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function edit(string $id)
    {
        $category = $this->CustomerGroups->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->CustomerGroups->patchEntity($category, $this->request->getData());
            if ($this->CustomerGroups->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/crm/groups/edit/{$id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $category = $this->CustomerGroups->get($id);
        if ($this->CustomerGroups->delete($category)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/crm/groups');
    }
}
