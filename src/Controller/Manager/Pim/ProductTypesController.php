<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;
use Cake\Utility\Text;

class ProductTypesController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'types');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        $types = $this->paginate($this->fetchTable('Taxonomies')->getTypes());

        $this->set('types', $types);

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $type = $this->fetchTable('Taxonomies')->newEmptyEntity();
        if ($this->request->is('post')) {
            $type = $this->fetchTable('Taxonomies')->patchEntity($type, $this->request->getData());
            $type->slug = Text::slug($type->name);
            $type->type = 'types';
            if ($this->fetchTable('Taxonomies')->save($type)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-types');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('type'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $type = $this->fetchTable('Taxonomies')->getType($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $type = $this->fetchTable('Taxonomies')->patchEntity($type, $this->request->getData());
            $type->slug = Text::slug($type->name);
            if ($this->fetchTable('Taxonomies')->save($type)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-types');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('type'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response
     */
    public function delete(string $id): Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $type = $this->fetchTable('Taxonomies')->getType($id);
        if ($this->fetchTable('Taxonomies')->delete($type)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/product-types');
    }
}
