<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\ClientusersTable $Clientusers
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
        $limit = (int) $this->request->getQuery('show_entries', 25);
        $query = $this->fetchTable('Clientusers')->getAllUsers($this->request->getQuery('keyword'));
        $users = $this->paginate($query, ['limit' => $limit]);

        $this->set('users', $users);
    }

    public function view(string $id)
    {
        $user = $this->fetchTable('Clientusers')->get($id);

        $this->set('user', $user);
    }

    public function add()
    {
        $user = $this->fetchTable('Clientusers')->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->fetchTable('Clientusers')->patchEntity($user, $this->request->getData());
            $user->status = 'active';
            if ($this->fetchTable('Clientusers')->save($user)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/client-users");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('user'));
    }

    public function edit(string $id)
    {
        $user = $this->fetchTable('Clientusers')->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->fetchTable('Clientusers')->patchEntity($user, $this->request->getData());
            if ($this->fetchTable('Clientusers')->save($user)) {
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
        $user = $this->fetchTable('Clientusers')->getUser($id);
        $user->status = 'deleted';
        if ($this->fetchTable('Clientusers')->save($user)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/settings/client-users');
    }

    public function changePassword(string $id)
    {
        $user = $this->fetchTable('Clientusers')->getUser($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user->password = $this->request->getData('password');
            if ($this->fetchTable('Clientusers')->save($user)) {
                $this->Flash->success(__('The password has been updated.'));
            } else {
                $this->Flash->error(__('The password could not be updated. Please try again.'));
            }

            return $this->redirect("/manager/settings/client-users/edit/{$id}");
        }

        $this->set('user', $user);
    }
}