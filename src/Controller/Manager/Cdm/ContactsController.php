<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cdm;

class ContactsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cdm_menu');
        $this->set('subMenuActive', 'customers');
        $this->set('applicationName', __('Customer data management'));
        $this->set('objectMenuActive', 'contacts');
    }

    public function index(string $customerId)
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $contacts = $this->Contacts->find()->where(['customer_id' => $customerId]);

        $this->set(compact('customer', 'contacts'));
    }

    public function add(string $customerId)
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            $contact->customer_id = $customerId;
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/contacts/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('customer', 'contact'));
    }

    public function edit(string $customerId, string $id)
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $contact = $this->Contacts->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/contacts/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('customer', 'contact'));
    }

    public function delete(string $customerId, string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/cdm/customers/contacts/{$customerId}");
    }
}