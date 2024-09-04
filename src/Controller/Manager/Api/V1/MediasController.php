<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\View\JsonView;
use Cake\Utility\Text;

/**
 * @property \App\Model\Table\PostsTable $Posts
 */
class MediasController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index(): \Cake\Http\Response
    {
        $data = [];
        $this->set('posts', $data);
        $this->viewBuilder()->setOption('serialize', 'data');

        return $this->render();
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $connection = ConnectionManager::get('default');
        $connection->begin();

        $webroot = WWW_ROOT;
        $attachment = $this->request->getUploadedFile('feature_image');
        $fileName = str_replace(['.jpg', '.png'], '', $attachment->getClientFilename());
        $fileName = Text::slug($fileName);
        $fileExtension = ['image/jpeg' => '.jpg', 'image/png' => '.png'];

        $media = $this->Medias->newEntity([
            'filename' => "{$fileName}{$fileExtension[$attachment->getClientMediaType()]}",
            'path' => "{$webroot}storage/{$fileName}{$fileExtension[$attachment->getClientMediaType()]}",
            'size' => $attachment->getSize(),
            'mime' => $attachment->getClientMediaType(),
            'hash' => null,
            'using_type' => 'feature_image',
            'title' => $fileName,
            'description' => null,
            'alt' => $fileName,
            'order_index' => 0,
            'link_url' => 'https://',
            'uuid' => null,
        ]);
        if ($this->Medias->save($media)) {
            // upload file to storage
            // if could not be uploaded will sending error message
            $attachment = $this->request->getUploadedFile('feature_image');

            if (
                !$attachment->getError() &&
                !$attachment->moveTo("{$webroot}storage/{$fileName}{$fileExtension[$attachment->getClientMediaType()]}")
            ) {
                $connection->commit();
                $message = 'Saved';
            } else {
                $connection->rollback();
                $message = 'Error';
            }
        } else {
            $connection->rollback();
            $message = 'Error';
        }

        $this->set([
            'message' => $message,
            'media' => $media,
        ]);
        $this->viewBuilder()->setOption('serialize', ['media', 'message']);

        return $this->render();
    }
}
