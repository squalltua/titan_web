<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Users :: Edit') ?></h4>
            </div>
        </div>

        <?= $this->Form->create($user) ?>
        <div class="row">
            <div class="col-6">
            <div class="form-group mb-3">
                    <label for="name" class="form-label"><?= __('Full name') ?></label>
                    <?= $this->Form->text('full_name', ['class' => 'form-control form-control-sm', 'id' => 'full_name', 'required' => true]) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><?= __('E-mail') ?></label>
                    <?= $this->Form->email('email', ['class' => 'form-control form-control-sm', 'id' => 'email', 'required' => true]) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="role-id" class="form-label"><?= __('Role') ?></label>
                    <?= $this->Form->select('role_id', $roles, ['class' => 'form-select form-select-sm', 'id' => 'role-id']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="username" class="form-label"><?= __('Username') ?></label>
                    <?= $this->Form->text('username', ['class' => 'form-control form-control-sm', 'id' => 'username', 'required' => true]) ?>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary submit-btn']) ?>
                            <?= $this->Html->link(__('Back'), "/manager/settings/users", ['class' => 'btn btn-secondary']) ?>
                        </div>
                        <div>
                            <?= $this->Form->postLink(__('Delete'), "/manager/settings/users/delete/{$user->id}", ['class' => 'btn btn-danger', 'confirm' => __('Do you want delete this data?')]) ?>
                            <?= $this->Html->link(__('Change password'), "/manager/settings/users/change-password/{$user->id}", ['class' => 'btn btn-secondary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>