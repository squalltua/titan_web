<div class="card shadow-sm">
    <?= $this->element('object_info_customer') ?>
    <div class="card-body">
        <h4><?= __('Notes :: New') ?></h4>
        <?= $this->Form->create($note) ?>
            <div class="form-group mb-3">
                <label for="title" class="form-label"><?= __('Title') ?></label>
                <?= $this->Form->text('title', ['class' => 'form-control', 'required' => true]) ?>
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label"><?= __('Content') ?></label>
                <?= $this->Form->textarea('content', ['class' => 'form-control']) ?>
            </div>
            <div class="form-check mb-3">
                <?= $this->Form->checkbox('is_private', ['class' => 'form-check-input', 'id' => 'is-private']) ?>
                <label for="is-private" class="form-check-label"><?= __('Is private') ?></label>
            </div>
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Back'), "/manager/cdm/customers/notes/{$customer->id}", ['class' => 'btn btn-secondary']) ?>
        <?= $this->Form->end() ?>
    </div>    
</div>