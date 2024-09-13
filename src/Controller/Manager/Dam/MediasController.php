<?php

declare(strict_types=1);

namespace App\Controller\Manager\Dam;

use App\Controller\Manager\AppController;

class MediasController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'dam_menu');
        $this->set('subMenuActive', 'medias');
        $this->set('applicationName', __('Digital assets management'));
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