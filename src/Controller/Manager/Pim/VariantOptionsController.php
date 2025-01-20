<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;

class VariantOptionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'variants');
        $this->set('applicationName', __('Product information management'));
    }

    public function index()
    {
        $limit = $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keyword') ? ['name LIKE' => '%' . $this->request->getQuery('keyword') . '%'] : [];
        $attributes = $this->paginate($this->fetchTable('Attributes')->getAllAtributes($conditions), ['limit' => $limit]);

        $this->set(compact('attributes'));
    }

    public function add()
    {
        $attribute = $this->fetchTable('Attributes')->newEmptyEntity();
        if ($this->request->is('post')) {
            $attribute = $this->fetchTable('Attributes')->patchEntity($attribute, $this->request->getData());
            if ($this->fetchTable('Attributes')->save($attribute)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/variant-options/edit/{$attribute->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set(compact('attribute'));
    }

    public function edit(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $attribute = $this->fetchTable('Attributes')->getAttribute($id, $selectLanguage);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $variant = $this->fetchTable('Attributes')->patchEntity($attribute, $this->request->getData());
            if ($this->fetchTable('Attributes')->save($attribute)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/variant-options/edit/{$id}?lang={$selectLanguage}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('attribute', 'selectLanguage', 'languages'));
    }

    public function delete(string $id)
    {
        $this->request->allowMethod(['delete', 'post']);
        $attribute = $this->fetchTable('Attributes')->get($id);
        if ($this->fetchTable('Attributes')->delete($attribute)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }
    }

    public function optionAdd(string $id)
    {
        $attribute = $this->fetchTable('Attributes')->get($id);
        $option = $this->fetchTable('AttributeOptions')->newEmptyEntity();
        if ($this->request->is('post')) {
            $option = $this->fetchTable('AttributeOptions')->patchEntity($option, $this->request->getData());
            $option->attribute_id = $id;
            if ($this->fetchTable('AttributeOptions')->save($option)) {
                $this->Flash->success(__('The data has been saved.'));
            } else {
                $this->Flash->error(__('The data could not be saved. Please try again.'));
            }

            return $this->redirect("/manager/pim/variant-options/edit/{$id}");
        }

        $this->set(compact('attribute', 'option'));
    }

    /**
     * edit variant attribute option function
     *
     * @param string $id        variant id
     * @param string $optionId  option id
     * @return null|Response
     */
    public function optionEdit(string $id, string $optionId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $attribute = $this->fetchTable('Attributes')->get($id);
        $option = $this->fetchTable('AttributeOptions')->getOption($optionId, $selectLanguage);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $option = $this->fetchTable('AttributeOptions')->patchEntity($option, $this->request->getData());
            if ($this->fetchTable('AttributeOptions')->save($option)) {
                $this->Flash->success(__('The data has been saved.'));
            } else {
                $this->Flash->error(__('The data could not be saved. Please try again.'));
            }

            return $this->redirect("/manager/pim/variant-options/edit/{$id}");
        }

        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('attribute', 'option', 'selectLanguage', 'languages'));
    }

    public function optionDelete(string $id, string $optionId)
    {
        $this->request->allowMethod(['delete', 'post']);
        $option = $this->fetchTable('AttributeOptions')->get($optionId);
        if ($this->fetchTable('AttributeOptions')->delete($option)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/variant-options/edit/{$id}");
    }
}
