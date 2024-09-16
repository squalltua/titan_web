<?php
declare(strict_types=1);

namespace App\Controller\Client;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Utility\Hash;

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

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeRender(EventInterface $event)
    {
        $this->viewBuilder()->setTheme('DefaultTheme');
        $siteSettingData = $this->fetchTable('SiteSettings')->find('all');
        $siteSetting = Hash::combine($siteSettingData->toArray(), '{n}.key_field', '{n}.value_field');

        $this->set(compact('siteSetting'));
    }
}