<?php
declare(strict_types=1);

namespace App\Controller\Manager;

use Cake\Controller\Controller;

class AppController extends Controller
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        $this->viewBuilder()->setLayout('manager');

        $this->set('menuActive', '');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}