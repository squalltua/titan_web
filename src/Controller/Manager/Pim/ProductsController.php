<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'products');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * Index function
     *
     * @return \Cake\Http\Response
     */
    public function index(): Response
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
    public function view(string $id): Response
    {
        $product = $this->Products->get($id);

        $this->set(compact('product'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributes(string $id): Response
    {
        $product = $this->Products->get($id, ['contain' => 'Attributes']);

        $this->set(compact('product'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeAdd(string $productId): Response
    {
        $product = $this->Products->get($id);
        $attribute = $this->Products->Attributes->newEmptyEntity();
        if ($this->request->is('post')) {
            $attribute = $this->Products->Attributes->patchEntity($attribute, $this->request->getData());
            if (
                $this->Products->Attributes->save($attribute) &&
                $this->Products->Attributes->link($product, [$attribute])
            ) {
                $this->Flash->success(__('The attribute has been saved.'));

                return $this->redirect("/manager/pim/products/attributes/{$productId}");
            }

            $this->Flash->error(__('The attribute could not be saved. Please try again.'));
        }

        $this->set(compact('product', 'attribute'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeEdit(string $productId, string $attributeId): Response
    {
        $product = $thsi->Products->get($id);
        $attribute = $this->Products->Attributes->get($attributeId);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $attribute = $this->Products->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Products->Attributes->save($attribute)) {
                $this->Flash->success(__('The data has been saved.'));

                $this->redirect("/manager/pim/products/attributes/{$productId}");
            }

            $this->Flash->error(__('The attribute could not be saved. Please try again.'));
        }

        $this->set(compact('product', 'attribute'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeDelete(string $productId, string $attributeId): Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $attribute = $this->Products->Attributes->get($attributeId);
        if ($this->Products->Attributes->delete($attribute)) {
            $this->Flash->success(__('The attribute has been deleted.'));
        } else {
            $this->Flash->error(__('The attribute could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/products/attributes/{$productId}");
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): Response
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

        $categories = $this->Products->Taxonomies->getCategoriesList();
        $types = $this->Products->Taxonomies->getTypesList();

        $this->set(compact('product', 'categories', 'types'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): Response
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

        $categories = $this->Products->Taxonomies->getCategoriesList();
        $types = $this->Products->Taxonomies->getTypesList();

        $this->set(compact('product', 'categories', 'types'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): Response
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
