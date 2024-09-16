<?php

declare(strict_types=1);

namespace App\Controller\Client;

class PagesController extends AppController
{
    public function index()
    {
        // just page
    }

    public function pageNotFoundError()
    {
        $this->viewBuilder()->setLayout('error');
    }
}
