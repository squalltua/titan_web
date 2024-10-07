<?php
declare(strict_types=1);

namespace App\Controller\Manager\Cdm;

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

    public function index(string $customerId)
    {
        $customer = $this->fetchTable('Customers')->get($customerId);
        $orders = $this->PurchaseOrders->find()->where(['customer_id' => $customerId]);

        $this->set(compact('customer', 'orders'));
    }

    public function add(string $customerId)
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

        $this->set(compact('customer', 'order'));
    }

    public function edit(string $customerId, string $id)
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

        $this->set(compact('customer', 'order'));
    }

    public function delete(string $customerId, string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $order = $thsi->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->save($order)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        $this->redirect("/manager/cdm/customers/orders/{$customerId}");
    }
}