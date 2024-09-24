<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h2 class="m-0"><?= h($product->title) ?></h2>
            <div>
                <?= $this->Html->link(__('Edit'), "/manager/pim/products/edit/{$product->id}", ['class' => 'btn btn-primary']) ?>
            </div>
        </div> 
    </div>
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