<?php

namespace App\Controller\Manager\Api\V1;

use App\Controller\Manager\AppController;
use Cake\View\JsonView;

class VariantAttributesController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function getOptionList()
    {
        $attributeId = $this->request->getQuery('id');
        $options = $this->fetchTable('AttributeOptions')->find()->where(['attribute_id' => $attributeId]);

        $this->set('options', $options);
        $this->viewBuilder()->setOption('serialize', 'options');
    }
}