<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Role :: Edit') ?></h4>
            </div>
        </div>

        <?= $this->Form->create($role) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="title" class="form-label"><?= __('Role title') ?></label>
                    <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label"><?= __('Description') ?></label>
                    <?= $this->Form->text('description', ['class' => 'form-control', 'id' => 'description']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label"><?= __('Content') ?></label>
                    <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content', 'placeholder' => __('Optional')]) ?>
                </div>

                <div class="mt-4">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary btn submit-btn']) ?>
                    <?= $this->Html->link(__('Back'), "/manager/settings/roles", ['class' => 'btn btn-secondary btn']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>