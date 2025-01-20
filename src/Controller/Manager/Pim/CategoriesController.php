<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;
use Cake\Utility\Text;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
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
        $limit = $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keyword') ? ['name LIKE' => '%' . $this->request->getQuery('keyword') . '%'] : [];
        $categories = $this->paginate($this->Categories->getAllCategories($conditions), ['limit' => $limit]);

        $this->set(compact('categories'));

        return $this->render();
    }

    /**
     * @return Response
     */
    public function add(): Response
    {
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            $category->slug = Text::slug($category->name);
            $category->type = 'categories';
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/pim/categories');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $parents = $this->Categories->find('treeList');

        $this->set(compact('category', 'parents'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response
     */
    public function edit(string $id): Response
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $category = $this->Categories->getCategory($id, $selectLanguage);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            $category->slug = Text::slug($category->name);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/categories");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $parents = $this->Categories->find('treeList');
        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('category', 'parents', 'selectLanguage', 'languages'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response|null
     */
    public function delete(string $id): ?Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/categories');
    }

    /**
     * @return Response|null
     */
    public function recovery(): ?Response
    {
        $this->Categories->recover();
        $this->Flash->success(__('Recovery data'));

        return $this->redirect('/manager/pim/categories');
    }
}