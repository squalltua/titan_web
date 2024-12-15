<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Information') ?>
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
                <div class="datagrid">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Product name') ?></div>
                        <div class="datagrid-content"><?= $product->title ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('SKUs') ?></div>
                        <div class="datagrid-content"><?= $product->sku ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Category') ?></div>
                        <div class="datagrid-content"><?= $product->category->name ?? '-' ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Supplier price') ?></div>
                        <div class="datagrid-content"><?= $product->supplier_price ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Sell price') ?></div>
                        <div class="datagrid-content"><?= $product->sell_price ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Discount price') ?></div>
                        <div class="datagrid-content"><?= $product->discount_price ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Status') ?></div>
                        <div class="datagrid-content">
                            <span class="status status-secondary">
                                <?= $product->status ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row pt-3 mt-3 border-top">
                    <div class="col">
                        <small class="text-secondary">long description</small>
                        <h3 class="lh-1"><?= __('Content') ?></h3>
                        <div class="text-secondary mb-3"><?= nl2br($product->content) ?></div>
                    </div>
                    <div class="col-4">
                        <small class="text-secondary">short description</small>
                        <h3 class="lh-1"><?= __('Summary') ?></h3>
                        <div class="text-secondary mb-3"><?= nl2br($product->summary) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
