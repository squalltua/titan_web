<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('System configuration') ?>
                </div>
                <h2 class="page-title">
                    <?= __('System') ?>
                </h2>
            </div>

        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?= $this->Form->create() ?>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item me-auto">
                                <div class="card-title" data-bs-toggle="tab"><?= __('System information') ?></div>
                            </li>
                            <?php foreach ($languages as $key => $language): ?>
                            <li class="nav-item">
                                <a href="?lang=<?= $key ?>"
                                    class="nav-link <?= $key === $selectLanguage ? 'active' : '' ?>">
                                    <?= $language ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="site-name" class="col-3 col-form-label"><?= __('Site name') ?></label>
                            <div class="col">
                                <?= $this->Form->text('site_name', ['class' => 'form-control', 'id' => 'site-name', 'value' => $setting['site_name'] ?? null]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="telephone" class="col-3 col-form-label"><?= __('Telephone number') ?></label>
                            <div class="col">
                                <?= $this->Form->text('telephone', ['class' => 'form-control', 'id' => 'telephone', 'value' => $setting['telephone'] ?? null]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-3 col-form-label"><?= __('Address') ?></label>
                            <div class="col">
                                <?= $this->Form->textarea('address', ['class' => 'form-control', 'id' => 'address', 'value' => $setting['address'] ?? null]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact-email" class="col-3 col-form-label"><?= __('Contact E-mail') ?></label>
                            <div class="col">
                                <?= $this->Form->email('contact_email', ['class' => 'form-control', 'id' => 'contact-email', 'value' => $setting['contact_email'] ?? null]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="support_email" class="col-3 col-form-label"><?= __('Support E-mail') ?></label>
                            <div class="col">
                                <?= $this->Form->email('support_email', ['class' => 'form-control', 'id' => 'support-email', 'value' => $setting['support_email'] ?? null]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="social-accounts"
                                class="col-3 col-form-label"><?= __('Social accounts') ?></label>
                            <div class="col">
                                <?= $this->Form->text('social_accounts_1_url', ['class' => 'form-control mb-3', 'id' => 'social-accounts', 'value' => $setting['social_accounts_1_url'] ?? null]) ?>
                                <?= $this->Form->text('social_accounts_2_url', ['class' => 'form-control mb-3', 'id' => 'social-accounts', 'value' => $setting['social_accounts_2_url'] ?? null]) ?>
                                <?= $this->Form->text('social_accounts_3_url', ['class' => 'form-control mb-3', 'id' => 'social-accounts', 'value' => $setting['social_accounts_3_url'] ?? null]) ?>
                                <?= $this->Form->text('social_accounts_4_url', ['class' => 'form-control mb-3', 'id' => 'social-accounts', 'value' => $setting['social_accounts_4_url'] ?? null]) ?>
                                <?= $this->Form->text('social_accounts_5_url', ['class' => 'form-control mb-3', 'id' => 'social-accounts', 'value' => $setting['social_accounts_5_url'] ?? null]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>