<div class="card shadow-sm">
    <?= $this->element('object_info_product') ?>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <dl class="row">
                    <dt class="col-3"><?= __('Summary') ?></dt>
                    <dd class="col-9"><?= nl2br($product->summary) ?></dd>

                    <dt class="col-3"><?= __('Content') ?></dt>
                    <dd class="col-9"><?= nl2br($product->content) ?></dd>
                </dl>
            </div>
            <div class="col-6">
                <dl class="row">
                    <dt class="col-3"><?= __('SKUs') ?></dt>
                    <dd class="col-9"><?= $product->sku ?></dd>

                    <dt class="col-3"><?= __('Model') ?></dt>
                    <dd class="col-9"><?= $product->model_name ?></dd>

                    <dt class="col-3"><?= __('Series') ?></dt>
                    <dd class="col-9"><?= $product->series_number ?></dd>

                    <dt class="col-3"><?= __('Product family') ?></dt>
                    <dd class="col-9"><?= $product->product_family->name ?? __('- No -') ?></dd>

                    <dt class="col-3"><?= __('Category') ?></dt>
                    <dd class="col-9"><?= $product->category->name ?? __('- No -') ?></dd>

                    <dt class="col-3"><?= __('Type') ?></dt>
                    <dd class="col-9"><?= $product->type->name ?? __('- No -') ?></dd>

                    <dt class="col-3"><?= __('Base price') ?></dt>
                    <dd class="col-9"><?= $product->base_price ?></dd>

                    <dt class="col-3"><?= __('Sell price') ?></dt>
                    <dd class="col-9"><?= $product->sell_price ?></dd>

                    <dt class="col-3"><?= __('Discount price') ?></dt>
                    <dd class="col-9"><?= $product->discount_price ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>