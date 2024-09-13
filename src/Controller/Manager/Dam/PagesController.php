<?php

declare(strict_types=1);

namespace App\Controller\Manager\Dam;

use App\Controller\Manager\AppController;

class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'dam_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Digital assets management'));
    }

    public function dashboard() {}
}
