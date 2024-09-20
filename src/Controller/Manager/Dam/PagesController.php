<?php

declare(strict_types=1);

namespace App\Controller\Manager\Dam;

use App\Controller\Manager\AppController;

class PagesController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'dam_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Digital assets management'));
    }

    /**
     * Dashboard function
     *
     * @return \Cake\Http\Response
     */
    public function dashboard()
    {
        // load dashboard here.
    }
}
