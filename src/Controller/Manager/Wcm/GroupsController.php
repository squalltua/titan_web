<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;
use Cake\Http\Exception\NotFoundException;

class GroupsController extends AppController
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
    public function index()
    {
        try {
            $groups = $this->paginate($this->Groups);
        } catch (NotFoundException $e) {
            // Do something here like redirecting to first or last page.
            // $e->getPrevious()->getAttributes('pagingParams') will give you required info.
        }

        $this->set(compact('groups'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $group = $this->Groups->newEmptyEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            $group->type = 'groups';
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $this->set(compact('group'));
    }

    /**
     * @param string $id - Group ID
     * @return \Cake\Http\Response
     */
    public function edit(string $id)
    {
        $group = $this->Groups->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $this->set(compact('group'));
    }

    /**
     * @param string $id - Group ID
     * @return \Cake\Http\Response
     */
    public function delete(string $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect('/manager/wcm/groups');
    }
}