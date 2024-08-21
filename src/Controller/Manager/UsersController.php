<?php
declare(strict_types=1);

namespace App\Controller\Manager;

use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;
use Cake\Utility\Security;

/**
 * Users controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'initializeData']);
        $this->set('menuActive', 'users');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(string $id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(string $id = null): ?\Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string|null $id
     * @return \Cake\Http\Response|null
     */
    public function changePassword(string $id = null): ?\Cake\Http\Response
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect("/manager/users/edit/{$id}");
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function login(): ?\Cake\Http\Response
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
     * @return \Cake\Http\Response|null
     */
    public function logout(): ?\Cake\Http\Response
    {
        $this->Authentication->logout();
        return $this->redirect('/manager/login');
    }

    public function initializeData(): ?\Cake\Http\Response
    {
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $userAdmin = $this->Users->find()->where(['username' => 'admin', 'role' => 'admin'])->first();
        if (!$userAdmin) {
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

            // $password = Security::randomString(8);
            $password = 'admin';
            $user = $this->Users->newEntity([
                'username' => 'admin',
                'role' => 'admin',
                'full_name' => 'admin admin',
                'email' => 'admin@titanscript.com',
                'is_superadmin' => 1,
                'password' => $password,
                'status' => 'active',
            ]);

            if ($this->fetchTable('SiteSettings')->saveMany($settings) && $this->Users->save($user)) {
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
