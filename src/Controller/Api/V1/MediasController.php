<?php

namespace App\Controller\Api\V1;

use App\Controller\AppController;
use Cake\Routing\Route\Route;
use Cake\View\JsonView;

class MediasController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function getImage(string $slug)
    {
        // $file = $this->Attachments->getFile($slug);
        $file = $this->Medias->findByFilename($slug)->first();
        $response = $this->response->withFile($file->path);
        // Return the response to prevent controller from trying to render
        // a view.
        return $response;
    }
}
