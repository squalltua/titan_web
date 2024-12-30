<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;
use Cake\Http\Response;
use Cake\Utility\Text;

/**
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('subMenuActive', 'roles');
        $this->set('applicationName', __('Settings management'));
    }

    /**
     * @return Response|null
     */
    public function index()
    {
        $limit = (int) $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keyword') ? ['title LIKE' => "%{$this->request->getQuery('keyword')}%"] : [];
        $roles = $this->paginate($this->Roles->getAllRoles($conditions), ['limit' => $limit]);
        
        $this->set('roles', $roles);
    }

    /**
     * @return Response|null
     */
    public function add()
    {
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $role->status = 'active';
            $role->slug = Text::slug($role->title);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/settings/roles');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set('role', $role);

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response|null
     */
    public function edit(string $id): ?\Cake\Http\Response
    {
        $role = $this->Roles->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $role->slug = Text::slug($role->title);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect('/manager/settings/roles');
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set('role', $role);

        return $this->render();
    }

    /**
     * @param string $id
     * @return Response|null
     */
    public function delete(string $id): ?Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $role = $this->Roles->get($id);
        $role->status = 'inactive';
        if ($this->Roles->save($role)) {
            $this->Flash->success(__('The data has been inactived.'));
        } else {
            $this->Flash->error(__('The data could not be inactived. Please try again.'));
        }

        return $this->redirect('/manager/settings/roles');
    }
}
