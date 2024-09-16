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
        $medias = $this->paginate($this->Medias);

        $this->set(compact('medias'));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData('attachment');
            $media = $this->Medias->uploadImage('general', $data);
            if ($media) {
                $this->Flash->success(__('The image has been uploaded.'));
            } else {
                $this->Flash->error(__('The image could not be uploaded. Please try again.'));
            }

            return $this->redirect('/manager/dam/medias');
        }
    }
    
    public function edit(string $id)
    {
        $media = $this->Medias->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect('/manager/dam/medias');
            }

            $this->Flash->error(__('The image could not be saved. Please try again.'));
        }

        $this->set('media', $media);
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $media = $this->Medias->get($id);
        if (unlink($media->path) && $this->Medias->delete($media)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/dam/medias');
    }
}