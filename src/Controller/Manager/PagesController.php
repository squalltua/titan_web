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

    /**
     * @return Response
     */
    public function pageNotFoundError(): Response
    {
        $this->viewBuilder()->setLayout('error');
        return $this->render();
    }
}