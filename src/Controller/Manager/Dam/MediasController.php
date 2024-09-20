<?php

declare(strict_types=1);

namespace App\Controller\Manager\Dam;

use App\Controller\Manager\AppController;
use Cake\Http\Response;

class MediasController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'dam_menu');
        $this->set('subMenuActive', 'medias');
        $this->set('applicationName', __('Digital assets management'));
    }

    /**
     * Undocumented function
     *
     * @return \Cake\Http\Response
     */
    public function index(): Response
    {
        $medias = $this->paginate($this->Medias);

        $this->set(compact('medias'));
    }

    /**
     * Add media
     *
     * @return \Cake\Http\Response
     */
    public function add(): Response
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

        return $this->render();
    }

    /**
     * Edit media function
     *
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): Response
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

    /**
     * Delete media function
     *
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): Response
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
