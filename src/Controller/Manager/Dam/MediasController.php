<?php

declare(strict_types=1);

namespace App\Controller\Manager\Dam;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\MediasTable $Medias
 */
class MediasController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'dam');
        $this->set('subMenu', 'dam_menu');
        $this->set('subMenuActive', 'medias');
    }

    /**
     * Undocumented function
     *
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        $medias = $this->paginate($this->Medias);

        $this->set(compact('medias'));

        return $this->render();
    }

    /**
     * Add media
     *
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
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
    public function edit(string $id): \Cake\Http\Response
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

        return $this->render();
    }

    /**
     * Delete media function
     *
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $media = $this->Medias->get($id);
        
        if (file_exists($media->path) && !is_dir($media->path)) {
            unlink($media->path);
        }

        if ($this->Medias->delete($media)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/dam/medias');
    }
}
