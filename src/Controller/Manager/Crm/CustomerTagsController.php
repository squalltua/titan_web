<?php

declare(strict_types=1);

namespace App\Controller\Manager\Crm;

use App\Controller\Manager\AppController;

class CustomerTagsController extends AppController
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
        $tags = $this->paginate($this->fetchTable('CustomerGroups'));

        $this->set(compact('tags'));
    }

    public function add()
    {
        $tag = $this->fetchTable('CustomerGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->fetchTable('CustomerGroups')->patchEntity($tag, $this->request->getData());
            if ($this->fetchTable('CustomerGroups')->save($tag)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/crm/tags');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('tag'));
    }

    public function edit(string $id)
    {
        $tag = $this->fetchTable('CustomerGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $tag = $this->fetchTable('CustomerGroups')->patchEntity($tag, $this->request->getData());
            if ($this->fetchTable('CustomerGroups')->save($tag)) {
                $this->Flash->error(__('The data has been saved.'));

                return $this->redirect('/manager/crm/tags');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('tag'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $tag = $this->fetchTable('CustomerGroups')->get($id);
        if ($this->fetchTable('CustomerGroups')->delete($tag)) {
            $this->Flash->success(__('The data has been saved.'));
        } else {
            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        return $this->redirect('/manager/crm/tags');
    }
}
