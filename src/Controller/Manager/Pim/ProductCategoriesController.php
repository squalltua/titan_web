<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

class ProductCategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'categories');
        $this->set('applicationName', __('Product information management'));
    }

    public function index() : \Cake\Http\Response
    {
        $categories = $this->paginate($this->fetchTable('ProductGroups')->getCategoriesList());
        debug($categories);exit;

        $this->set(compact('categories'));

        return $this->render();
    }

    public function add()
    {
        $category = $this->fetchTable('ProductGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->fetchTable('ProductGroups')->patchEntity($category, $this->request->getData());
            $category->type = 'categories';
            if ($this->fetchTable('ProductGroups')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/categories');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function edit(string $id)
    {
        $category = $this->fetchTable('ProductGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->fetchTable('ProductGroups')->patchEntity($category, $this->request->getData());
            if ($this->fetchTable('ProductGroups')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/categories/edit/{$id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $category = $this->fetchTable('ProductGroups')->get($id);
        if ($this->fetchTable('ProductGroups')->delete($category)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/categories');
    }
}
