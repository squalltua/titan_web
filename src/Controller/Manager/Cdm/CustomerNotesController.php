<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cdm;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\CustomerNotesTable $CustomerNotes
 */
class CustomerNotesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cdm_menu');
        $this->set('subMenuActive', 'customers');
        $this->set('applicationName', __('Customer data management'));
        $this->set('objectMenuActive', 'notes');
    }

    /**
     * Customer notes method
     *
     * @param string $customerId
     * @return \Cake\Http\Response
     */
    public function index(string $customerId): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $notes = $this->CustomerNotes->find()->where(['customer_id' => $customerId]);

        $this->set(compact('customer', 'notes'));

        return $this->render();
    }

    /**
     * Customer notes add method
     *
     * @param string $customerId
     * @return \Cake\Http\Response
     */
    public function add(string $customerId): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $note = $this->CustomerNotes->newEmptyEntity();
        if ($this->request->is('post')) {
            $note = $this->CustomerNotes->patchEntity($note, $this->request->getData());
            $note->customer_id = $customerId;
            if ($this->CustomerNotes->save($note)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/notes/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('customer', 'note'));

        return $this->render();
    }

    /**
     * Customer notes edit method
     *
     * @param string $customerId
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $customerId, string $id): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $note = $this->CustomerNotes->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $note = $this->CustomerNotes->patchEntity($note, $this->request->getData());
            if ($this->CustomerNotes->save($note)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/notes/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('customer', 'note'));

        return $this->render();
    }

    /**
     * Customer notes delete method
     *
     * @param string $customerId
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $customerId, string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $note = $this->CustomerNotes->get($id);
        if ($this->CustomerNotes->delete($note)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/cdm/customers/notes/{$customerId}");
    }
}
