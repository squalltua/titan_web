<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Variants') ?>
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
            <?php if (!empty($product->variants)): ?>
            <div class="card-body">
                <a href="/manager/pim/products/variant-add/<?= $product->id ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    <?= __('New variant') ?>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-nowrap datatable">
                    <thead>
                        <tr>
                            <th><?= __('Title') ?></th>
                            <th><?= __('SKU') ?></th>
                            <th><?= __('Variant') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Stock') ?></th>
                            <th class="w-1"><?= __('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product->variants as $variant): ?>
                        <tr>
                            <td><?= h($variant->title) ?></td>
                            <td><?= h($variant->sku) ?></td>
                            <td><?= h($variant->attribute_options_display) ?></td>
                            <td><?= h($variant->sell_price) ?></td>
                            <td><?= h($variant->stock_quantity) ?></td>
                            <td class="text-end">
                                <?= $this->Html->link(__('Edit'), "/manager/pim/products/variant-edit/{$product->id}/{$variant->id}", ['class' => 'me-3']) ?>
                                <?= $this->Html->link(__('Delete'), "/manager/pim/products/variant-delete/{$product->id}/{$variant->id}", ['class' => 'text-danger']) ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php elseif (!$product->has_variants): ?>
            <div class="container-xl d-flex flex-column justify-content-center">
                <div class="empty">
                    <div class="empty-img">
                        <?= $this->Html->image('undraw_undraw_choose_color_uotg_5ah4.svg', ['height' => 128]) ?>
                    </div>
                    <p class="empty-title"><?= __('This product no need to add variant') ?></p>
                    <p class="empty-subtitle text-secondary">
                        <?= __("This product is setting for no variant product.") ?>
                    </p>
                </div>
            </div>
            <?php else: ?>
            <div class="container-xl d-flex flex-column justify-content-center">
                <div class="empty">
                    <div class="empty-img">
                        <?= $this->Html->image('undraw_blank_canvas_re_2hwy.svg', ['height' => 128]) ?>
                    </div>
                    <p class="empty-title"><?= __('No results found') ?></p>
                    <p class="empty-subtitle text-secondary">
                        <?= __("Try adjusting your search or filter to find what you're looking for.") ?>
                    </p>
                    <div class="empty-action">
                        <a href="/manager/pim/products/variant-add/<?= $product->id ?>" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <?= __('Add your first product variant') ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>