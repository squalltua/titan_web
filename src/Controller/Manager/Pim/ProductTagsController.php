<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

class ProductTagsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'tags');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $tag = $this->fetchTable('ProductGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->fetchTable('ProductGroups')->patchEntity($tag, $this->request->getData());
            $tag->type = 'tags';
            if ($this->fetchTable('ProductGroups')->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect('/manager/pim/tags');
            }

            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $tag = $this->fetchTable('ProductGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $tag = $this->fetchTable('ProductGroups')->patchEntity($tag, $this->request->getData());
            if ($this->fetchTable('ProductGroups')->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect('/manager/pim/tags');
            }

            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->fetchTable('ProductGroups')->get($id);
        if ($this->fetchTable('ProductGroups')->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
            return $this->redirect('/manager/pim');
        }

        $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        return $this->redirect("/manager/pim/tags/edit/{$id}");
    }
}
