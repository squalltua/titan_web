<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Product Families :: Edit') ?></h4>
            </div>
        </div>
        <?= $this->Form->create($family) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="name" class="form-label"><?= __('Family name') ?></label>
                    <?= $this->Form->text('name', ['class' => 'form-control', 'id' => 'name']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label"><?= __('Description') ?></label>
                    <?= $this->Form->textarea('description', ['class' => 'form-control', 'id' => 'description']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Cancel'), '/manager/pim/product-families', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>