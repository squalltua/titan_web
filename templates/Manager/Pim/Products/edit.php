<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Edit information') ?>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Product information') ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="title" class="col-3 col-form-label required"><?= __('Product name') ?></label>
                            <div class="col">
                                <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label form="summary" class="col-3 col-form-label required"><?= __('Summary') ?></label>
                            <div class="col">
                                <?= $this->Form->textarea('summary', ['class' => 'form-control', 'id' => 'summary', 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="content" class="col-3 col-form-label required"><?= __('Content') ?></label>
                            <div class="col">
                                <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content', 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="category-id" class="col-3 col-form-label"><?= __('Category') ?></label>
                            <div class="col">
                                <?= $this->Form->select('category_id', $categories, ['class' => 'form-select', 'id' => 'category-id', 'empty' => __('Please select')]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label"><?= __('On sell') ?></label>
                            <div class="col">
                                <label class="form-check pt-2">
                                    <?= $this->Form->checkbox('on_sell', ['class' => 'form-check-input', 'id' => 'on-sale', 'hiddenField' => true, 'required' => false]) ?>
                                    <span class="form-check-label"><?= __('This product is on sell') ?></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="start-at" class="col-3 col-form-label"><?= __('Start at') ?></label>
                            <div class="col">
                                <?= $this->Form->datetime('start_at', ['class' => 'form-control', 'id' => 'start-at']) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="end-at" class="col-3 col-form-label"><?= __('End at') ?></label>
                            <div class="col">
                                <?= $this->Form->datetime('end_at', ['class' => 'form-control', 'id' => 'end-at']) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="col-3 col-form-label"><?= __('Status') ?></label>
                            <div class="col">
                                <?= $this->Form->select('status', ['active' => __('Active'), 'inactive' => __('Inactive')], ['class' => 'form-select', 'empty' => false]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label"><?= __('Has variants') ?></label>
                            <div class="col">
                                <label class="form-check pt-2">
                                    <?= $this->Form->checkbox('has_variants', ['class' => 'form-check-input', 'id' => 'has-variant', 'hiddenField' => true, 'required' => false]) ?>
                                    <span class="form-check-label"><?= __('This product has variant') ?></span>
                                </label>
                            </div>
                        </div>
                        <?php if (!$product->has_variants): ?>
                        <fieldset class="form-fieldset">
                            <legend class="fs-5"><?= __('Product additional information for no variant') ?></legend>
                            <div class="mb-3 row">
                                <label for="sku" class="col-3 col-form-label">SKU</label>
                                <div class="col">
                                    <?= $this->Form->text('sku', ['class'=> 'form-control', 'id' => 'sku']) ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="supplier-price"
                                    class="col-3 col-form-label"><?= __('Supplier price') ?></label>
                                <div class="col">
                                    <?= $this->Form->number('supplier_price', ['class' => 'form-control', 'id' => 'supplier-price']) ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="sell-price" class="col-3 col-form-label"><?= __('Sell price') ?></label>
                                <div class="col">
                                    <?= $this->Form->number('sell_price', ['class' => 'form-control', 'id' => 'sell-price']) ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="discount-price"
                                    class="col-3 col-form-label"><?= __('Discount price') ?></label>
                                <div class="col">
                                    <?= $this->Form->number('discount_price', ['class' => 'form-control', 'id' => 'discount-price']) ?>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="strock-quantity"
                                    class="col-3 col-form-label"><?= __('Stock quantity') ?></label>
                                <div class="col">
                                    <?= $this->Form->number('stock_quantity', ['class' => 'form-control', 'id' => 'stock-quantity']) ?>
                                </div>
                            </div>
                        </fieldset>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <?= $this->Html->link(__('Cancel'), "/manager/pim/products/detail/{$product->id}", ['class' => 'btn btn-link']) ?>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>