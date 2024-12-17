<?php

declare(strict_types=1);

namespace App\Controller\Manager;

use Cake\Http\Response;

class PagesController extends AppController
{
    public function index(): \Cake\Http\Response
    {
        return $this->render();
    }

    public function pageNotFoundError()
    {
        $this->viewBuilder()->setLayout('error');
    }
}
