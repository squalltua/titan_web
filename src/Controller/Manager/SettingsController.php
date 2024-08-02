<?php

namespace App\Controller\Manager;

use App\Controller\Manager\AppController;

class SettingsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'system');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function system(): \Cake\Http\Response
    {
        $setting = $this->fetchTable('SiteSettings')->getSiteSetting();
        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            if ($this->fetchTable('SiteSettings')->saveSiteSetting($data)) {
                $this->Flash->success(__('The data has been updated.'));
            } else {
                $this->Flash->error(__('The data could not be updated. Please, try again.'));
            }

            return $this->redirect('/manager/settings/system');
        }

        $this->set(compact('setting'));

        return $this->render();
    }
}