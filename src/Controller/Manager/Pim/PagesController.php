<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;

class PagesController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'dashboard');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function dashboard(): Response
    {
        return $this->render();
    }
}
