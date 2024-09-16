<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Medias :: New') ?></h4>
            </div>
        </div>

        <?= $this->Form->create(null, ['type' => 'file']) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Image') ?></label>
                    <?= $this->Form->file('attachment', ['class' => 'form-control']) ?>
                </div>

                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>