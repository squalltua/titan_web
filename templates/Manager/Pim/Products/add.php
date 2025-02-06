<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create new') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Products') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/pim/products/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?= $this->Form->create($product) ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h3 class="card-title"><?= __('Product information') ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-lg-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label required"><?= __('Product name') ?></label>
                                    <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                                </div>
                                <div class="mb-3">
                                    <label form="summary" class="form-label required"><?= __('Summary') ?></label>
                                    <?= $this->Form->textarea('summary', ['class' => 'form-control', 'id' => 'summary', 'required' => true]) ?>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label required"><?= __('Content (Markdown syntex supported)') ?></label>
                                    <?= $this->Form->textarea(
                                        'content',
                                        [
                                            'class' => 'form-control',
                                            'id' => 'content',
                                            'required' => true,
                                            'rows' => '10',
                                            'style' => "width:100%; height:500px",
                                        ]
                                    ) ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="category-id" class="form-label"><?= __('Category') ?></label>
                                    <?= $this->Form->select('category_id', $categories, ['class' => 'form-select', 'id' => 'category-id']) ?>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label"><?= __('Has variants') ?></label>
                                    <div class="col">
                                        <label class="form-check pt-2">
                                            <?= $this->Form->checkbox('has_variants', ['class' => 'form-check-input', 'id' => 'has-variant', 'hiddenField' => true, 'required' => false]) ?>
                                            <span class="form-check-label"><?= __('This product has variant') ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), '/manager/pim/products', ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>