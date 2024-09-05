<?php

declare(strict_types=1);

namespace App\Controller\Manager\Crm;

use App\Controller\Manager\AppController;

class CustomersController extends AppController
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
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
    }

    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            $customer->status = 'active';
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/crm/customers');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Customers->CustomerGroups->getCategoriesList();
        $tags = $this->Customers->CustomerGroups->getTagsList();

        $this->set(compact('customer', 'categories', 'tags'));
    }

    public function edit(string $id)
    {
        $customer = $this->Customers->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/crm/customers/edit/{$id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Customers->CustomerGroups->getCategoriesList();
        $tags = $this->Customers->CustomerGroups->getTagsList();

        $this->set(compact('customer', 'categories', 'tags'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $customer = $this->Customers->get($id);
        $customer->status = 'deleted';
        if ($this->Customers->save($customer)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/crm/customers');
    }
}
