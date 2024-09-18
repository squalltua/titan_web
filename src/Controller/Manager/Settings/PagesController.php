<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Settings management'));
    }

    public function dashboard() {}
}
