<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;
use Cake\Http\Exception\NotFoundException;

class PostGroupsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'wcm_menu');
        $this->set('subMenuActive', 'groups');
        $this->set('applicationName', __('Web content management'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        try {
            $groups = $this->paginate($this->PostGroups);
        } catch (NotFoundException $e) {
            // Do something here like redirecting to first or last page.
            // $e->getPrevious()->getAttributes('pagingParams') will give you required info.
        }

        $this->set(compact('groups'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $group = $this->PostGroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $group = $this->PostGroups->patchEntity($group, $this->request->getData());
            $group->type = 'groups';
            if ($this->PostGroups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $this->set(compact('group'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $group = $this->PostGroups->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $group = $this->PostGroups->patchEntity($group, $this->request->getData());
            if ($this->PostGroups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $this->set(compact('group'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->PostGroups->get($id);
        if ($this->PostGroups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
            return $this->redirect('/manager/wcm/groups');
        }

        $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        return $this->redirect("/manager/wcm/groups/edit/{$id}");
    }
}
