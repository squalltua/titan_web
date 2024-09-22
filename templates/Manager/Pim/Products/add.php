<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Products :: New') ?></h4>
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
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Cancel'), '/manager/pim/products', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>