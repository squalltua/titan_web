<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

class ProductsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Product information management'));
    }

    public function index() 
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    public function view(string $id)
    {
        $product = $this->Products->get($id);

        $this->set(compact('product'));
    }

    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->status = 'active';
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/view/{$product->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Products->ProductGroups->getCategoriesList();
        $tags = $this->Products->ProductGroups->getTagsList();

        $this->set(compact('product', 'categories', 'tags'));
    }

    public function edit(string $id)
    {
        $product = $this->Products->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/view/{$product->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Products->ProductGroups->getCategoriesList();
        $tags = $this->Products->ProductGroups->getTagsList();

        $this->set(compact('product', 'categories', 'tags'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $product = $this->Products->get($id);
        $product->status = 'deleted';
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/products');
    }
}
