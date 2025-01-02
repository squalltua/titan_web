<?php

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

/**
 * SystemSettings Controller
 *
 * @property \App\Model\Table\SiteSettingsTable $SiteSettings
 * @method \App\Model\Entity\SiteSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SystemSettingsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'settings_menu');
        $this->set('applicationName', __('Site setting and System'));
        $this->set('subMenuActive', 'system');
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