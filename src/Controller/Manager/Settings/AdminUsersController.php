<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\AdminusersTable $Adminusers
 */
class AdminUsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'settings');
        $this->set('subMenu', 'settings_menu');
        $this->set('subMenuActive', 'admin_users');
    }

    public function index()
    {
        $limit = (int) $this->request->getQuery('show_entries', default: 25);
        $query = $this->fetchTable('Adminusers')->getAllUsers($this->request->getQuery('keyword'));
        $users = $this->paginate($query, ['limit' => $limit]);

        $this->set('users', $users);
    }

    public function view(string $id)
    {
        $user = $this->fetchTable('Adminusers')->get($id, ['contain' => ['Roles']]);

        $this->set('user', $user);
    }

    public function add()
    {
        $user = $this->fetchTable('Adminusers')->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->fetchTable('Adminusers')->patchEntity($user, $this->request->getData());
            $user->status = 'active';
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/admin-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $roles = $this->AdminUsers->Roles->getList();

        $this->set(compact('user', 'roles'));
    }

    public function edit(string $id)
    {
        $user = $this->fetchTable('Adminusers')->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->fetchTable('Adminusers')->patchEntity($user, $this->request->getData());
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/admin-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $roles = $this->fetchTable('Adminusers')->Roles->getList();

        $this->set(compact('user', 'roles'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $user = $this->fetchTable('Adminusers')->getUser($id);
        $user->status = 'deleted';
        if ($this->fetchTable('Adminusers')->save($user)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/settings/admin-users');
    }

    public function changePassword(string $id)
    {
        $user = $this->fetchTable('Adminusers')->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user->password = $this->request->getData('password');
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The password has been updated.'));
            } else {
                $this->Flash->error(__('The password could not be updated. Please try again.'));
            }

            return $this->redirect("/manager/settings/admin-users/edit/{$id}");
        }

        $this->set('user', $user);
    }
}