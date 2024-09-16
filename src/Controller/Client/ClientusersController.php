<?php

declare(strict_types=1);

namespace App\Controller\Client;

class ClientusersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {

    }

    public function logout()
    {

    }
}