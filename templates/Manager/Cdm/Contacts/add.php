<div class="card shadow-sm">
    <?= $this->element('object_info_customer') ?>
    <div class="card-body">
        <h4><?= __('Contacts :: New') ?></h4>
        <?= $this->Form->create($contact) ?>
            <div class="form-group mb-3">
                <label for="contact-first-name" class="form-label"><?= __('First name') ?></label>
                <?= $this->Form->text('first_name', ['class' => 'form-control', 'id' => 'contact-first-name']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="contact-last-name" class="form-label"><?= __('Last name') ?></label>
                <?= $this->Form->text('last_name', ['class' => 'form-control', 'id' => 'contact-last-name']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="contact-phone" class="form-label"><?= __('Contact phone') ?></label>
                <?= $this->Form->text('phone', ['class' => "form-control", 'id' => 'contact-phone']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="contact-email" class="form-label"><?= __('Contact email') ?></label>
                <?= $this->Form->email('email', ['class' => 'form-control', 'id' => 'contact-email']) ?>
            </div>
            <div class="form-group mb-3">
                <label for="contact-position" class="form-label"><?= __('Contact position') ?></label>
                <?= $this->Form->text('position', ['class' => 'form-control', 'id' => 'contact-position']) ?>
            </div>
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Back'), "/manager/cdm/customers/contacts/{$customer->id}", ['class' => 'btn btn-secondary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>