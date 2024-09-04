<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cms;

use App\Controller\Manager\AppController;

class CmsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cms_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Content management system'));
    }

    public function dashboard() {}
}
