<?php
declare(strict_types=1);

namespace App\Controller\Manager\Cdm;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 */
class PurchaseOrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cdm_menu');
        $this->set('subMenuActive', 'customers');
        $this->set('applicationName', __('Customer data management'));
        $this->set('objectMenuActive', 'orders');
    }

    /**
     * Purchase order method
     *
     * @param string $customerId
     * @return \Cake\Http\Response
     */
    public function index(string $customerId): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $orders = $this->paginate($this->PurchaseOrders->find()->where(['customer_id' => $customerId]));

        $this->set(compact('customer', 'orders'));

        return $this->render();
    }

    /**
     * Purchase order add method
     *
     * @param string $customerId
     * @return \Cake\Http\Response
     */
    public function add(string $customerId): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $order = $this->PurchaseOrders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->PurchaseOrders->patchEntity($order, $this->request->getData());
            $order->customer_id = $customerId;
            if ($this->PurchaseOrders->save($order)) {
                $this->Flash->success(__('The data has been saved.'));

                $this->redirect("/manager/cdm/customers/orders/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $statuses = $this->PurchaseOrders->getStatuses();

        $this->set(compact('customer', 'order', 'statuses'));

        return $this->render();
    }

    /**
     * Purchase order edit method
     *
     * @param string $customerId
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $customerId, string $id): \Cake\Http\Response
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $order = $this->PurchaseOrders->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $order = $this->PurchaseOrders->patchEntity($order, $this->request->getData());
            if ($this->PurchaseOrders->save($order)) {
                $this->Flash->success(__('The data has been saved.'));

                $this->redirect("/manager/cdm/customers/orders/{$customerId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $statuses = $this->PurchaseOrders->getStatuses();

        $this->set(compact('customer', 'order', 'statuses'));

        return $this->render();
    }

    /**
     * Purchase order delete method
     *
     * @param string $customerId
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $customerId, string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $order = $this->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->save($order)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/cdm/customers/orders/{$customerId}");
    }
}
