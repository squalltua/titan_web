<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="d-flex-grow-1">
                <h4><?= __('Customers :: Edit') ?></h4>
            </div>
        </div>
        <?= $this->Form->create($customer) ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="type" class="form-label"><?= __('Type') ?></label>
                        <?= $this->Form->select(
                            'type',
                            $companyTypes,
                            ['class' => 'form-select', 'required' => true]
                        ) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title" class="form-label"><?= __('Title') ?></label>
                        <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label"><?= __('Phone') ?></label>
                        <?= $this->Form->text('phone', ['class' => 'form-control', 'id' => 'phone']) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label"><?= __('Email') ?></label>
                        <?= $this->Form->email('email', ['class' => 'form-control', 'id' => 'email', 'required' => true]) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address-line-1" class="form-label"><?= __('Address line 1') ?></label>
                        <?= $this->Form->text('address_line_1', ['class' => 'form-control', 'id' => 'address-line-1']) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address-line-2" class="form-label"><?= __('Address line 2') ?></label>
                        <?= $this->Form->text('address_line_2', ['class' => 'form-control', 'id' => "address-line-2"]) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="city" class="form-label"><?= __('City') ?></label>
                        <?= $this->Form->text('city', ['class' => 'form-control', 'id' => 'city']) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="province" class="form-label"><?= __('Province') ?></label>
                        <?= $this->Form->text('province', ['class' => 'form-control', 'id' => 'province']) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="postcode" class="form-label"><?= __('Postcode') ?></label>
                        <?= $this->Form->text('postcode', ['class' => 'form-control', 'id' => 'postcode']) ?> 
                    </div>
                    <div class="form-group mb-3">
                        <label for="contact-type" class="form-label"><?= __('Contact type') ?></label>
                        <?= $this->Form->text('contact_type', ['class' => 'form-control', 'id' => 'contact-type']) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="service-type" class="form-label"><?= __('Service type') ?></label>
                        <?= $this->Form->select('service_type', $serviceTypes, ['class' => 'form-select']) ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header"><?= __('Contact person information') ?></div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="contact-first-name" class="form-label"><?= __('First name') ?></label>
                                <?= $this->Form->text('contacts.0.first_name', ['class' => 'form-control', 'id' => 'contact-first-name']) ?>
                                <?= $this->Form->hidden('contacts.0.id') ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact-last-name" class="form-label"><?= __('Last name') ?></label>
                                <?= $this->Form->text('contacts.0.last_name', ['class' => 'form-control', 'id' => 'contact-last-name']) ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact-phone" class="form-label"><?= __('Contact phone') ?></label>
                                <?= $this->Form->text('contacts.0.phone', ['class' => "form-control", 'id' => 'contact-phone']) ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact-email" class="form-label"><?= __('Contact email') ?></label>
                                <?= $this->Form->email('contacts.0.email', ['class' => 'form-control', 'id' => 'contact-email']) ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact-position" class="form-label"><?= __('Contact position') ?></label>
                                <?= $this->Form->text('contacts.0.position', ['class' => 'form-control', 'id' => 'contact-position']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Back'), "/manager/cdm/customers/detail/{$customer->id}", ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>