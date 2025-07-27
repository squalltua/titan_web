<?php

declare(strict_types=1);

namespace App\Controller\Manager\Settings;

use App\Controller\Manager\AppController;

class LanguagesController extends AppController
{
    function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'settings');
        $this->set('subMenu', 'settings_menu');
        $this->set('subMenuActive', 'languages');
    }

    /**
     * Language list method
     *
     * @return Response|null
     */
    public function index()
    {
        $languages = $this->paginate($this->Languages->find('all'));
        $this->set(compact('languages'));
    }

    /**
     * Add language method
     *
     * @return Response|null
     */
    public function add()
    {
        $language = $this->Languages->newEmptyEntity();
        if ($this->request->is('post')) {
            $language = $this->Languages->patchEntity($language, $this->request->getData());
            if ($this->Languages->save($language)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/languages");
            }

            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }

        $this->set(compact('language'));
    }

    /**
     * Edit language method
     *
     * @param string|null $id Language id
     * @return Response|null
     */
    public function edit($id = null)
    {
        $language = $this->Languages->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $language = $this->Languages->patchEntity($language, $this->request->getData());
            if ($this->Languages->save($language)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/settings/languages");
            }

            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }

        $this->set(compact('language'));
    }

    /**
     * Delete language method
     *
     * @param string|null $id Language id
     * @return Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $language = $this->Languages->get($id);
        if ($this->Languages->delete($language)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please, try again.'));
        }

        return $this->redirect("/manager/settings/languages");
    }
}