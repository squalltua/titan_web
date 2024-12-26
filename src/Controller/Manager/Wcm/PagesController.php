<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;

class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'wcm_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Web content management'));
    }

    public function dashboard()
    {
        // just a page. no code here.
    }
}
