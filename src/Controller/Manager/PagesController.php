<?php
declare(strict_types=1);

namespace App\Controller\Manager;

class PagesController extends AppController
{
    public function index(): \Cake\Http\Response
    {
        return $this->render();
    }

    public function pageNotFoundError(): \Cake\Http\Response
    {
        return $this->render();
    }
}