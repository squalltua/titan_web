<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Edit information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Client Users') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/settings/client-users/add" class="btn btn-primary d-none d-sm-inline-block">
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
        <?= $this->Form->create($user) ?>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= __('Admin user information') ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="full-name" class="form-label required"><?= __('Full name') ?></label>
                            <?= $this->Form->text('full_name', ['class' => 'form-control', 'id' => 'full-name', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label required"><?= __('E-mail') ?></label>
                            <?= $this->Form->email('email', ['class' => 'form-control', 'id' => 'email', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="phone-number" class="form-label"><?= __('Phone number') ?></label>
                            <?= $this->Form->text('phone_number', ['class' => 'form-control', 'id' => 'phone-number']) ?>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label required"><?= __('Username') ?></label>
                            <?= $this->Form->text('username', ['class' => 'form-control', 'id' => 'username', 'required' => true]) ?>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), '/manager/settings/admin-users', ['class' => 'btn btn-link me-3']) ?>
                            <?= $this->Html->link(__('Change password'), "/manager/settings/admin-users/change-password/{$user->id}", ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>