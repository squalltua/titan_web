<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;
use Cake\Utility\Security;

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
        $config = ConnectionManager::getConfig('default');
        $connection = new Connection($config);
        $connection->begin();

        if (!$this->fetchTable('Adminusers')->alreadyHaveAdmin()) {
            // create setting data
            if (!$this->fetchTable('SiteSettings')->initSiteSettingData()) {
                echo '<p>Could not initial site setting data.</p>';
                $connection->rollback();
                exit;
            }
            // end create setting data

            // create role data
            if (!$this->fetchTable('Roles')->initRolesData()) {
                echo '<p>Could not initial role data.</p>';
                $connection->rollback();
                exit;
            }
            // end create role data
            
            // get admin role
            $adminRole = $this->fetchTable('Roles')->findBySlug('admin')->first();

            // create admin user
            $password = Security::randomString(8);
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
