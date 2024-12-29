<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Customer') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/cdm/customers/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <?= $this->element('object_info_customer') ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <?= $this->Form->create($order) ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= __('Order information') ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="title" class="col-3 col-form-label required"><?= __('Title') ?></label>
                                    <div class="col">
                                        <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content" class="col-3 col-form-label"><?= __('Content') ?></label>
                                    <div class="col">
                                        <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount-total"
                                           class="col-3 col-form-label required"><?= __('Amount total') ?></label>
                                    <div class="col">
                                        <?= $this->Form->number('amount_total', ['class' => 'form-control', 'required' => true]) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount-discount"
                                           class="col-3 col-form-label required"><?= __('Amount discount') ?></label>
                                    <div class="col">
                                        <?= $this->Form->number('amount_discount', ['class' => 'form-control', 'required' => true]) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount-tax" class="col-3 col-form-label required"><?= __('Amount TAX') ?></label>
                                    <div class="col">
                                        <?= $this->Form->number('amount_tax', ['class' => 'form-control', 'required' => true]) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount-net" class="col-3 col-form-label required"><?= __('Amount NET') ?></label>
                                    <div class="col">
                                        <?= $this->Form->number('amount_net', ['class' => 'form-control', 'required' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <?= $this->Html->link(__('Cancel'), "/manager/cdm/customers/orders/{$customer->id}", ['class' => 'btn btn-link']) ?>
                                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
