<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;

/**
 * Users controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'initializeData']);
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('subMenuActive', 'users');
        $this->set('applicationName', __('Settings management'));
    }

    /**
     * Index method
     *
     * @return Response Renders view
     */
    public function index(): Response
    {
        $query = $this->fetchTable('Adminusers')->find()->contain(['Roles']);
        $users = $this->paginate($query);

        $this->set(compact('users'));

        return $this->render();
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(): ?Response
    {
        $user = $this->fetchTable('Adminusers')->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->fetchTable('Adminusers')->patchEntity($user, $this->request->getData());
            $user->status = 'active';
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $roles = $this->fetchTable('Roles')->find('list');

        $this->set(compact('user', 'roles'));

        return $this->render();
    }

    /**
     * Edit method
     * @param string|null $id User id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(string $id = null): ?Response
    {
        $user = $this->fetchTable('Adminusers')->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->fetchTable('Adminusers')->patchEntity($user, $this->request->getData());
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $roles = $this->fetchTable('Roles')->find('list');

        $this->set(compact('user', 'roles'));

        return $this->render();
    }

    /**
     * Delete method
     * @param string|null $id User id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->fetchTable('Adminusers')->get($id);
        if ($this->fetchTable('Adminusers')->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string|null $id
     * @return Response|null
     */
    public function changePassword(string $id = null): ?Response
    {
        $user = $this->fetchTable('Adminusers')->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->fetchTable('Adminusers')->patchEntity($user, $this->request->getData());
            if ($this->fetchTable('Adminusers')->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect("/manager/users/edit/{$id}");
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));

        return $this->render();
    }

    /**
     * @return Response|null
     */
    public function login(): ?Response
    {
        $this->viewBuilder()->setLayout('login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/manager';
            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

        return $this->render();
    }

    /**
     * @return Response|null
     */
    public function logout(): ?Response
    {
        $this->Authentication->logout();
        return $this->redirect('/manager/login');
    }

    public function initializeData(): ?Response
    {
        $connection = ConnectionManager::get('default');
        $connection->begin();

        $userAdmin = $this->fetchTable('Adminusers')->find()->where(['username' => 'admin'])->first();
        if (!$userAdmin) {
            // create setting data
            $settings = $this->fetchTable('SiteSettings')->newEntities([
                ['key_field' => 'site_name', 'value_field' => 'Site name'],
                ['key_field' => 'telephone', 'value_field' => " "],
                ['key_field' => 'address', 'value_field' => " "],
                ['key_field' => 'contact_email', 'value_field' => " "],
                ['key_field' => 'support_email', 'value_field' => " "],
                ['key_field' => 'sns_facebook_name', 'value_field' => " "],
                ['key_field' => 'sns_facebook_url', 'value_field' => " "],
                ['key_field' => 'sns_twitter_name', 'value_field' => " "],
                ['key_field' => 'sns_twitter_url', 'value_field' => " "],
                ['key_field' => 'sns_instagram_name', 'value_field' => " "],
                ['key_field' => 'sns_instagram_url', 'value_field' => " "],
                ['key_field' => 'sns_tiktok_name', 'value_field' => " "],
                ['key_field' => 'sns_tiktok_url', 'value_field' => " "],
            ]);
            if ($this->fetchTable('SiteSettings')->saveMany($settings)) {
                echo '<p>Create setting done.</p>';
            }
            // end create setting data

            // create role data
            $roles = $this->fetchTable('Roles')->newEntities([
                [
                    'title' => 'Admin',
                    'slug' => 'admin',
                    'status' => 'active',
                ],
                [
                    'title' => 'Staff',
                    'slug' => 'staff',
                    'status' => 'active',
                ]
            ]);
            if ($this->fetchTable('Roles')->saveMany($roles)) {
                echo '<p>Create role done.</p>';
            }
            $adminRole = $this->fetchTable('Roles')->findBySlug('admin')->first();
            // end create role data

            // $password = Security::randomString(8);
            $password = 'admin';
            $user = $this->fetchTable('Adminusers')->newEntity([
                'username' => 'admin',
                'role_id' => $adminRole->id,
                'full_name' => 'admin admin',
                'email' => 'admin@titanscript.com',
                'password' => $password,
                'status' => 'active',
            ]);

            if ($this->fetchTable('Adminusers')->save($user)) {
                $connection->commit();
                $this->Flash->success(__('The data has been initiated. password is {0}', $password));
            } else {
                $connection->rollback();
                $this->Flash->error(__('The data could be initiated. Please, try again.'));
            }
        } else {
            $connection->rollback();
            echo '!error';
            exit;
        }

        return $this->redirect('/manager/login');
    }
}
