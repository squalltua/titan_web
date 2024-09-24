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
        <h4><?= __('Attribute :: New') ?></h4>
        <?= $this->Form->create($attribute) ?>
            <div class="form-group mb-3">
                <label for="name" class="form-label"><?= __('Name') ?></label>
                <?= $this->Form->text('name', ['class' => 'form-control', 'id' => 'name']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label"><?= __('Content') ?></label>
                <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
            </div>
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Back'), "/manager/pim/products/attributes/{$product->id}", ['class' => 'btn btn-secondary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>