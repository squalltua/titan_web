<?php

namespace App\Controller\Api\V1;

use App\Controller\AppController;
use Cake\View\JsonView;

/**
 * @property \App\Model\Table\PostsTable $Posts
 */
class MediasController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function getImage()
    {
        // $file = $this->Attachments->getFile($slug);
        $image = WWW_ROOT . 'storage/test-image.png';
        $response = $this->response->withFile($image);
        // Return the response to prevent controller from trying to render
        // a view.
        return $response;
    }
}
