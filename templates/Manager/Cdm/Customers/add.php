<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create new') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Customers') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/cdm/customers/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?= $this->Form->create($customer) ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Customer information') ?></h3>
            </div>
            <div class="card-body">
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
                            <label for="country" class="form-label"><?= __('Country') ?></label>
                            <?= $this->Form->text('country', ['class' => 'form-control', 'id' => 'country']) ?>
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
                        <label class="form-label"><?= __('Contact person information') ?></label>
                        <fieldset class="form-fieldset">
                            <div class="form-group mb-3">
                                <label for="contact-first-name" class="form-label"><?= __('First name') ?></label>
                                <?= $this->Form->text('contacts.0.first_name', ['class' => 'form-control', 'id' => 'contact-first-name']) ?>
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
                                <label for="contact-position"
                                       class="form-label"><?= __('Contact position') ?></label>
                                <?= $this->Form->text('contacts.0.position', ['class' => 'form-control', 'id' => 'contact-position']) ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <?= $this->Html->link(__('Cancel'), '/manager/cdm/customers', ['class' => 'btn btn-link']) ?>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
