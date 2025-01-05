<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create new') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Languages') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/settings/languages/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?= $this->Form->create($language) ?>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= __('Language information') ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="title" class="col-4 col-form-label required"><?= __('Title') ?></label>
                            <div class="col">
                                <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="unicode" class="col-4 col-form-label required"><?= __('Code') ?></label>
                            <div class="col">
                                <?= $this->Form->text('unicode', ['class' => 'form-control', 'id' => 'unicode', 'required' => true]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="is-default" class="col-4 col-form-label">
                                <?= __('This language is default') ?>
                            </label>
                            <div class="col">
                                <label class="form-check pt-2">
                                    <?= $this->Form->checkbox('is_default', ['class' => 'form-check-input', 'id' => 'is-default']) ?>
                                    <span class="form-check-label"><?= __('Default language ') ?></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), '/manager/settings/languages', ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>