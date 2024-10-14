<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;

/**
 * @property \App\Model\Table\ProductsTable $ProductFamilies
 */
class ProductFamiliesController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'families');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return Response
     */
    public function index(): \Cake\Http\Response
    {
        $families = $this->paginate($this->ProductFamilies);
        $this->set('families', $families);

        return $this->render();
    }

    /**
     * @return Response
     */
    public function add(): Response
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

        return $this->render();
    }

    /**
     * edit function
     *
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): Response
    {
        $family = $this->ProductFamilies->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $family = $this->ProductFamilies->patchEntity($family, $this->request->getData());
            if ($this->ProductFamilies->save($family)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-families');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('family'));

        return $this->render();
    }

    /**
     * delete method
     *
     * @param string $id
     * @return \Cake\Http\Response
     */
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
