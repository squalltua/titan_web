<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Text;

class GroupsController extends AppController
{
    protected array $paginate = [
        'limit' => 25,
        'order' => [
            'Groups.created' => 'desc',
        ],
    ];
    
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'content');
        $this->set('subMenu', 'wcm_menu');
        $this->set('subMenuActive', 'groups');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $limit = (int) $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keyword') ? ['name LIKE' => "%{$this->request->getQuery('keyword')}%"] : [];
        $groups = $this->paginate($this->Groups->getAllGroups($conditions), ['limit' => $limit]);

        $this->set(compact('groups'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $group = $this->Groups->newEmptyEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            $group->type = 'groups';
            $group->slug = Text::slug(strtolower($group->name));
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $this->set(compact('group'));
    }

    /**
     * @param string $id - Group ID
     * @return \Cake\Http\Response
     */
    public function edit(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $group = $this->Groups->getGroup($id, $selectLanguage);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            $group->slug = Text::slug(strtolower($group->name));
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect('/manager/wcm/groups');
            }

            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('group', 'selectLanguage', 'languages'));
    }

    /**
     * @param string $id - Group ID
     * @return \Cake\Http\Response
     */
    public function delete(string $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect('/manager/wcm/groups');
    }
}