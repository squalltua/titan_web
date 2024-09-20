<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

class ProductFamiliesController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'families');
        $this->set('applicationName', __('Product information management'));
    }

    public function index()
    {
        $families = $this->paginate($this->ProductFamilies);
        $this->set('families', $families);
    }

    public function add()
    {
        $family = $this->ProductFamilies->newEmptyEntity();
        if ($this->request->is('post')) {
            $family = $this->ProductFamilies->patchEntity($family, $this->request->getData());
            if ($this->ProductFamilies->save($family)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-families');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('family'));
    }

    public function edit(string $id)
    {
        $family = $this->ProductFamilies->get($id);
        if ($this->request->is('post')) {
            $family = $this->ProductFamilies->patchEntity($family, $this->request->getData());
            if ($this->ProductFamilies->save($family)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-families');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('family'));
    }

    public function delete(string $id)
    {
        
        $this->request->allowMethod(['delete', 'post']);
        $family = $this->ProductFamilies->get($id);
        if ($this->ProductFamilies->delete($family)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/product-families');
    }
}
