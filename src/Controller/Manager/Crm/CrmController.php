<?php

declare(strict_types=1);

namespace App\Controller\Manager\Crm;

use App\Controller\Manager\AppController;

class CrmController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'crm_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Customer relationship managment'));
    }

    public function dashboard() {}
}
