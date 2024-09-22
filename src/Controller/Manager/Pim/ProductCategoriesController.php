<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Utility\Text;

class ProductCategoriesController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'categories');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $categories = $this->paginate($this->fetchTable('Taxonomies')->getCategories());

        $this->set(compact('categories'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $category = $this->fetchTable('Taxonomies')->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->fetchTable('Taxonomies')->patchEntity($category, $this->request->getData());
            $category->slug = Text::slug($category->name);
            $category->type = 'categories';
            if ($this->fetchTable('Taxonomies')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/product-categories');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function edit(string $id)
    {
        $category = $this->fetchTable('Taxonomies')->getCategory($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->fetchTable('Taxonomies')->patchEntity($category, $this->request->getData());
            $category->slug = Text::slug($category->name);
            if ($this->fetchTable('Taxonomies')->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/product-categories");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('category'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $category = $this->fetchTable('Taxonomies')->getCategory($id);
        if ($this->fetchTable('Taxonomies')->delete($category)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/product-categories');
    }
}
