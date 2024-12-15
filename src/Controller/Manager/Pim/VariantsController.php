<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Client\AppController;

class VariantsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'variants');
        $this->set('applicaionName', __('Product information management'));
    }

    public function index()
    {

    }

    public function add()
    {

    }

    public function edit(string $id)
    {

    }

    public function delete(string $id)
    {
        
    }
}