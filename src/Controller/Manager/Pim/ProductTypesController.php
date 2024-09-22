<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Utility\Text;

class ProductTypesController extends AppController
{
    /**
     * @return void
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
    public function index()
    {
        $types = $this->paginate($this->fetchTable('Taxonomies')->getTypes());

        $this->set('types', $types);
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add()
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
    }

    /**
     * @return \Cake\Http\Response
     */
    public function edit(string $id)
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
    }

    /**
     * @return \Cake\Http\Response
     */
    public function delete(string $id)
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
