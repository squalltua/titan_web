<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cdm;

use App\Controller\Manager\AppController;

class CustomersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cdm_menu');
        $this->set('subMenuActive', 'customers');
        $this->set('applicationName', __('Customer data management'));
    }

    /**
     * Customer index list method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
    }

    public function detail(string $id)
    {
        $customer = $this->Customers->get($id, ['contain' => ['Contacts']]);

        $this->set('objectMenuActive', 'detail');
        $this->set('customer', $customer);
    }

    /**
     * Customer add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['status'] = 'active';
            $customer = $this->Customers->patchEntity($customer, $data, ['associated' => ['Contacts']]);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/detail/{$customer->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $companyTypes = $this->Customers->getListCompanyTypes();
        $serviceTypes = $this->Customers->getListServiceTypes();
    
        $this->set(compact('customer', 'companyTypes', 'serviceTypes'));
    }

    public function edit(string $id)
    {
        $customer = $this->Customers->get($id, ['contain' => ['Contacts']]);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/cdm/customers/detail/{$id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $companyTypes = $this->Customers->getListCompanyTypes();
        $serviceTypes = $this->Customers->getListServiceTypes();
    
        $this->set(compact('customer', 'companyTypes', 'serviceTypes'));
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

        return $this->redirect('/manager/cdm/customers');
    }
}
