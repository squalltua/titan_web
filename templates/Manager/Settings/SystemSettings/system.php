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
                        <div class="card-title"><?= __('System informaiton') ?></div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="site-name" class="col-3 col-form-label"><?= __('Site name') ?></label>
                            <div class="col">
                                <?= $this->Form->text('site_name', ['class' => 'form-control', 'id' => 'site-name', 'value' => $setting['site_name']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="telephone" class="col-3 col-form-label"><?= __('Telephone number') ?></label>
                            <div class="col">
                                <?= $this->Form->text('telephone', ['class' => 'form-control', 'id' => 'telephone', 'value' => $setting['telephone']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-3 col-form-label"><?= __('Address') ?></label>
                            <div class="col">
                                <?= $this->Form->textarea('address', ['class' => 'form-control', 'id' => 'address', 'value' => $setting['address']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact-email" class="col-3 col-form-label"><?= __('Contact E-mail') ?></label>
                            <div class="col">
                                <?= $this->Form->email('contact_email', ['class' => 'form-control', 'id' => 'contact-email', 'value' => $setting['contact_email']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="support_email" class="col-3 col-form-label"><?= __('Support E-mail') ?></label>
                            <div class="col">
                                <?= $this->Form->email('support_email', ['class' => 'form-control', 'id' => 'support-email', 'value' => $setting['support_email']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="sns-facabook-name" class="col-3 col-form-label"><?= __('Facebook') ?></label>
                            <div class="col">
                                <?= $this->Form->text('sns_facebook_name', ['class' => 'form-control mb-3', 'id' => 'sns-facebook-name', 'value' => $setting['sns_facebook_name']]) ?>
                                <?= $this->Form->text('sns_facebook_url', ['class' => 'form-control', 'id' => 'sns-facebook-url', 'value' => $setting['sns_facebook_url']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="sns-x" class="col-3 col-form-label"><?= __('Twitter/X.com') ?></label>
                            <div class="col">
                                <?= $this->Form->text('sns_twitter_name', ['class' => 'form-control mb-3', 'id' => 'sns-twitter-name', 'value' => $setting['sns_twitter_name']]) ?>
                                <?= $this->Form->text('sns_twitter_url', ['class' => 'form-control', 'id' => 'sns-twitter-url', 'value' => $setting['sns_twitter_url']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="instagram" class="col-3 col-form-label"><?= __('Instagram') ?></label>
                            <div class="col">
                                <?= $this->Form->text('sns_instagram_name', ['class' => 'form-control mb-3', 'id' => 'sns-instagram-name', 'value' => $setting['sns_instagram_name']]) ?>
                                <?= $this->Form->text('sns_instagram_url', ['class' => 'form-control', 'id' => 'sns-instagram-url', 'value' => $setting['sns_instagram_url']]) ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tiktok" class="col-3 col-form-label"><?= __('Tiktok') ?></label>
                            <div class="col">
                                <?= $this->Form->text('sns_tiktok_name', ['class' => 'form-control mb-3', 'id' => 'sns-tiktiok-name', 'value' => $setting['sns_tiktok_name']]) ?>
                                <?= $this->Form->text('sns_tiktok_url', ['class' => 'form-control', 'id' => 'sns-tiktok-url', 'value' => $setting['sns_tiktok_url']]) ?>
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