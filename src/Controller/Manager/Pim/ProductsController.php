<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Utility\Text;
use Cake\I18n\Number;

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
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
    public function detail(string $id)
    {
        $product = $this->Products->get($id);
        $product->base_price = Number::precision($product->base_price ?? 0.00, 2);
        $product->sell_price = Number::precision($product->sell_price ?? 0.00, 2);
        $product->discount_price = Number::precision($product->discount_price ?? 0.00, 2);

        $this->set('objectMenuActive', 'detail');
        $this->set(compact('product'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributes(string $id)
    {
        $product = $this->Products->get($id, ['contain' => 'Attributes']);

        $this->set('objectMenuActive', 'attributes');
        $this->set(compact('product'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeAdd(string $productId)
    {
        $product = $this->Products->get($productId);
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

        $this->set('objectMenuActive', 'attributes');
        $this->set(compact('product', 'attribute'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeEdit(string $productId, string $attributeId)
    {
        $product = $this->Products->get($productId);
        $attribute = $this->Products->Attributes->get($attributeId);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $attribute = $this->Products->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Products->Attributes->save($attribute)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/attributes/{$productId}");
            }

            $this->Flash->error(__('The attribute could not be saved. Please try again.'));
        }

        $this->set('objectMenuActive', 'attributes');
        $this->set(compact('product', 'attribute'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function attributeDelete(string $productId, string $attributeId)
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
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->status = 'active';
            $product->adminuser_id = $this->Authentication->getIdentity()->get('id');
            $product->slug = Text::slug($product->title);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/view/{$product->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Products->Taxonomies->getCategoriesList();
        $types = $this->Products->Taxonomies->getTypesList();
        $families = $this->Products->ProductFamilies->find('list');


        $this->set(compact('product', 'categories', 'types', 'families'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
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

        $categories = $this->Products->Taxonomies->getCategoriesList();
        $types = $this->Products->Taxonomies->getTypesList();
        $families = $this->Products->ProductFamilies->find('list');


        $this->set(compact('product', 'categories', 'types', 'families'));
    }

    /**
     * @param string $id - product id
     * @return \Cake\Http\Response
     */
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

    public function images(string $productId)
    {
        $product = $this->Products->get($productId, ['contain' => 'Attributes']);

        $this->set('objectMenuActive', 'images');
        $this->set(compact('product'));
    }
}
