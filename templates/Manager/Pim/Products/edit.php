<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Products :: Edit') ?></h4>
            </div>
        </div>
        <?= $this->Form->create($product) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="title" class="form-label"><?= __('Product name') ?></label>
                    <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="summary" class="form-label"><?= __('Summary') ?></label>
                    <?= $this->Form->textarea('summary', ['class' => 'form-control', 'id' => 'summary']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label"><?= __('Content') ?></label>
                    <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="sku" class="form-label"><?= __('SKUs') ?></label>
                    <?= $this->Form->text('sku', ['class' => 'form-control', 'id' => 'sku']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="model-name" class="form-label"><?= __('Model name') ?></label>
                    <?= $this->Form->text('model_name', ['class' => 'form-control', 'id' => 'model-name']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="series-number" class="form-label"><?= __('Series number') ?></label>
                    <?= $this->Form->text('series_number', ['class' => 'form-control', 'id' => 'series-number']) ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="family-id" class="form-label"><?= __('Family') ?></label>
                    <?= $this->Form->select('family_id', $families, ['class' => 'form-select', 'empty' => __('Optional')]) ?>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="on-sale" name="on_sale">
                    <label class="form-check-label" for="flexCheckDefault"><?= __('On sale') ?></label>
                  </div>
                <div class="form-group mb-3">
                    <label for="base-price" class="form-label"><?= __('Base price') ?></label>
                    <?= $this->Form->number('base_price', ['class' => 'form-control', 'id' => 'base-price']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="sell-price" class="form-label"><?= __('Sell price') ?></label>
                    <?= $this->Form->number('sell_price', ['class' => 'form-control', 'id' => 'sell-price']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="discount-price" class="form-label"><?= __('Discount price') ?></label>
                    <?= $this->Form->number('discount_price', ['class' => 'form-control', 'id' => 'discount-price']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="start-at" class="form-label"><?= __('Start at') ?></label>
                    <?= $this->Form->date('start_at', ['class' => 'form-control', 'id' => 'start-at']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="end-at" class="form-label"><?= __('End at') ?></label>
                    <?= $this->Form->date('end_at', ['class' => 'form-control', 'id' => 'end-at']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="form-label"><?= __('Status') ?></label>
                    <?= $this->Form->select('status', ['active' => __('Active'), 'inactive' => __('Inactive')], ['class' => 'form-select', 'empty' => false]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Back'), "/manager/pim/products/detail/{$product->id}", ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>