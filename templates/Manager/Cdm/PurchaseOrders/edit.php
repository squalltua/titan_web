<div class="card shadow-sm">
    <?= $this->element('object_info_customer') ?>
    <div class="card-body">
        <h4><?= __('Orders :: Edit') ?></h4>
        <?= $this->Form->create($order) ?>
            <div class="form-group mb-3">
                <label for="title" class="form-label"><?= __('Title') ?></label>
                <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label"><?= __('Content') ?></label>
                <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="amount-total" class="form-label"><?= __('Amount total') ?></label>
                <?= $this->Form->number('amount_total', ['class' => 'form-control']) ?>
            </div>
            <div class="formr-group mb-3">
                <label for="amount-discount" class="form-label"><?= __('Amount discount') ?></label>
                <?= $this->Form->number('amount_discount', ['class' => 'form-control']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="amount-tax" class="form-label"><?= __('Amount TAX') ?></label>
                <?= $this->Form->number('amount_tax', ['class' => 'form-control']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="amount-net" class="form-label"><?= __('Amount NET') ?></label>
                <?= $this->Form->number('amount_net', ['class' => 'form-control']) ?>
            </div>
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Back'), "/manager/cdm/customers/orders/{$customer->id}", ['class' => 'btn btn-secondary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>