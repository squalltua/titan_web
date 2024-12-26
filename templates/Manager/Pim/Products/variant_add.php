<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create New Variant information') ?>
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
        <div class="card">
            <?= $this->element('object_info_product') ?>
            <div class="card-body">
                <?= $this->Form->create($variant) ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= __('Variant :: information') ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3 row">
                                    <label for="title" class="col-3 col-form-label required"><?= __('Title') ?></label>
                                    <div class="col">
                                        <?= $this->Form->text('title', ['class' => 'form-control', 'required' => true, 'id' => 'title']) ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="sku" class="col-3 col-form-label required"><?= __('SKU') ?></label>
                                    <div class="col">
                                        <?= $this->Form->text('sku', ['class' => 'form-control', 'required' => true, 'id' => 'sku']) ?>
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
                                    <label for="strock-quantity" class="col-3 col-form-label"><?= __('Stock quantity') ?></label>
                                    <div class="col">
                                        <?= $this->Form->number('stock_quantity', ['class' => 'form-control', 'id' => 'stock-quantity']) ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="status" class="col-3 col-form-label"><?= __('Status') ?></label>
                                    <div class="col">
                                        <?= $this->Form->select('status', ['active' => __('Active'), 'inactive' => __('Inactive')], ['class' => 'form-select', 'id' => 'status']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), "/manager/pim/products/variants/{$product->id}", ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
