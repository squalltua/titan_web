<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\ClientusersTable $ClientUsers
 */
class ClientUsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('applicationName', __('Site setting and System'));
        $this->set('subMenuActive', 'client_users');
    }

    public function index()
    {
        $query = $this->ClientUsers->find()
            ->select([
                'ClientUsers.id',
                'ClientUsers.username',
                'ClientUsers.full_name',
                'ClientUsers.status',
                'ClientUsers.email',
                'ClientUsers.created',
                'ClientUsers.modified',
            ]);

        $users = $this->paginate($query);

        $this->set('users', $users);
    }

    public function view(string $id)
    {
        $user = $this->ClientUsers->get($id);

        $this->set('user', $user);
    }

    public function add()
    {
        $user = $this->ClientUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->ClientUsers->patchEntity($user, $this->request->getData());
            $user->status = 'active';
            if ($this->ClientUsers->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/client-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('user'));
    }

    public function edit(string $id)
    {
        $user = $this->ClientUsers->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->ClientUsers->patchEntity($user, $this->request->getData());
            if ($this->ClientUsers->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/client-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('user'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $user = $this->ClientUsers->getUser($id);
        $user->status = 'deleted';
        if ($this->ClientUsers->save($user)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/settings/client-users');
    }

    public function changePassword(string $id)
    {
        $user = $this->ClientUsers->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user->password = $this->request->getData('password');
            if ($this->ClientUsers->save($user)) {
                $this->Flash->success(__('The password has been updated.'));
            } else {
                $this->Flash->error(__('The password could not be updated. Please try again.'));
            }

            return $this->redirect("/manager/settings/client-users/edit/{$id}");
        }

        $this->set('user', $user);
    }
}