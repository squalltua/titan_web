<?php

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;
use Cake\I18n\I18n;

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
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        // I18n::setLocale($selectLanguage);

        $setting = $this->fetchTable('SiteSettings')->getSiteSetting($selectLanguage);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            if ($this->fetchTable('SiteSettings')->saveSiteSetting($data, $selectLanguage)) {
                $this->Flash->success(__('The data has been updated.'));
            } else {
                $this->Flash->error(__('The data could not be updated. Please, try again.'));
            }

            return $this->redirect('/manager/settings/system?lang=' . $selectLanguage);
        }

        $languages = $this->fetchTable('Languages')->getTabList();
        $this->set(compact('setting', 'languages', 'selectLanguage'));
        
        return $this->render();
    }
}