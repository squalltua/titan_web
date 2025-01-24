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

        $this->Authentication->allowUnauthenticated(['login', 'initializeData', 'resetDataAdmin']);
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

            // create language data
            if (!$this->fetchTable('Languages')->initLanguagesData()) {
                echo '<p>Could not initial language data.</p>';
                $connection->rollback();
                exit;
            }
            // end create language data
            
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

    public function resetDataAdmin(): ?Response
    {
        exit(); // remove this line to enable this function
        $user = $this->fetchTable('Adminusers')->findByUsername('admin')->first();
        $user->password = 'admin';
        if ($this->fetchTable('Adminusers')->save($user)) {
            $this->Flash->success(__('The data has been reset. password is admin'));
        } else {
            $this->Flash->error(__('The data could be reset. Please, try again.'));
        }

        return $this->redirect('/manager/login');
    }
}
