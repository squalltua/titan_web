<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cms;

use App\Controller\Manager\AppController;
use Cake\Http\Exception\NotFoundException;

class PostTagsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cms_menu');
        $this->set('subMenuActive', 'tags');
        $this->set('applicationName', __('Content management system'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        try {
            $tags = $this->paginate($this->fetchTable('PostGroups')->getTagsAll());
        } catch (NotFoundException $e) {
            // Do something here like redirecting to first or last page.
            // $e->getPrevious()->getAttributes('pagingParams') will give you required info.
        }

        $this->set(compact('tags'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $tag = $this->fetchTable('PostGroups')->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->fetchTable('PostGroups')->patchEntity($tag, $this->request->getData());
            $tag->type = 'tags';
            if ($this->fetchTable('PostGroups')->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect('/manager/cms/tags');
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
        $tag = $this->fetchTable('PostGroups')->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $tag = $this->fetchTable('PostGroups')->patchEntity($tag, $this->request->getData());
            if ($this->fetchTable('PostGroups')->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect('/manager/cms/tags');
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
        $tag = $this->fetchTable('PostGroups')->get($id);
        if ($this->fetchTable('PostGroups')->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
            return $this->redirect('/manager/cms');
        }

        $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        return $this->redirect("/manager/cms/tags/edit/{$id}");
    }
}
