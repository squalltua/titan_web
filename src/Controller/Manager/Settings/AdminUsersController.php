<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\AdminusersTable $AdminUsers
 */
class AdminUsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('applicationName', __('Site setting and System'));
        $this->set('subMenuActive', 'admin-users');
    }

    public function index()
    {
        $query = $this->AdminUsers->find()
            ->select([
                'AdminUsers.id',
                'AdminUsers.username',
                'AdminUsers.full_name',
                'AdminUsers.role_id',
                'AdminUsers.status',
                'AdminUsers.email',
                'AdminUsers.created',
                'AdminUsers.modified',
                'Roles.title',
            ])
            ->contain(['Roles']);

        $users = $this->paginate($query);

        $this->set('users', $users);
    }

    public function view(string $id)
    {
        $user = $this->AdminUsers->get($id, ['contain' => ['Roles']]);

        $this->set('user', $user);
    }

    public function add()
    {
        $user = $this->AdminUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->AdminUsers->patchEntity($user, $this->request->getData());
            $user->status = 'active';
            if ($this->AdminUsers->save($user)) {
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
        $user = $this->AdminUsers->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->AdminUsers->patchEntity($user, $this->request->getData());
            if ($this->AdminUsers->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/admin-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $roles = $this->AdminUsers->Roles->getList();

        $this->set(compact('user', 'roles'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $user = $this->AdminUsers->getUser($id);
        $user->status = 'deleted';
        if ($this->AdminUsers->save($user)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/settings/admin-users');
    }

    public function changePassword(string $id)
    {
        $user = $this->AdminUsers->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user->password = $this->request->getData('password');
            if ($this->AdminUsers->save($user)) {
                $this->Flash->success(__('The password has been updated.'));
            } else {
                $this->Flash->error(__('The password could not be updated. Please try again.'));
            }

            return $this->redirect("/manager/settings/admin-users/edit/{$id}");
        }

        $this->set('user', $user);
    }
}
