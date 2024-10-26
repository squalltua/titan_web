<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;
use Cake\Utility\Text;

class ProductCategoriesController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'categories');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->paginate($this->fetchTable('Taxonomies')->getCategories());

        $this->set(compact('categories'));

        return $this->render();
    }

    /**
     * @return Response
     */
    public function add(): Response
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

        $parents = $this->fetchTable('Taxonomies')->find('treeList')->where(['type' => 'categories']);

        $this->set(compact('category', 'parents'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response
     */
    public function edit(string $id): Response
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

        $parents = $this->fetchTable('Taxonomies')->find('treeList')->where(['type' => 'categories']);

        $this->set(compact('category', 'parents'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response|null
     */
    public function delete(string $id): ?Response
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

    /**
     * @return Response|null
     */
    public function recovery(): ?Response
    {
        $this->fetchTable('Taxonomies')->recover();
        $this->Flash->success(__('Recovery data'));

        return $this->redirect('/manager/pim/product-categories');
    }
}
