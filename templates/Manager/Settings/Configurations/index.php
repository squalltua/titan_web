<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('System') ?></h4>
            </div>
        </div>

        <?= $this->Form->create() ?>
        <div class="row">
            <div class="col-6">
                <h4><?= __('Company information') ?></h4>
                <div class="row mb-3">
                    <label for="site_name" class="col-4 col-form-label">
                        <?= __('Site name') ?>
                        <div class="text-muted">
                            <?= __('The name of company') ?>
                        </div>
                    </label>
                    <div class="col">
                        <?= $this->Form->text('site_name', ['class' => 'form-control', 'value' => $setting['site_name']]) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telephone" class="col-4 col-form-label"><?= __('Telephone number') ?></label>
                    <div class="col">
                        <?= $this->Form->text('telephone', ['class' => 'form-control', 'value' => $setting['telephone']]) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-4 col-form-label"><?= __('Address') ?></label>
                    <div class="col">
                        <?= $this->Form->textarea('address', ['class' => 'form-control', 'rows' => 3, 'value' => $setting['address']]) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="contact_email" class="col-4 col-form-label"><?= __('Contact email') ?></label>
                    <div class="col">
                        <?= $this->Form->email('contact_email', ['class' => 'form-control', 'value' => $setting['contact_email']]) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="support_email" class="col-4 col-form-label"><?= __('Support email') ?></label>
                    <div class="col">
                        <?= $this->Form->email('support_email', ['class' => 'form-control', 'value' => $setting['support_email']]) ?>
                    </div>
                </div>

                <h4 class="mt-4"><?= __('Social Network') ?></h4>
                <div class="form-group mb-3">
                    <label for="facebook" class="form-label"><?= __('Facebook') ?></label>
                    <div class="row">
                        <div class="col-4">
                            <?= $this->Form->text(
                                'sns_facebook_name',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('Account name'),
                                    'value' => $setting['sns_facebook_name']
                                ]
                            ) ?>
                        </div>
                        <div class="col">
                            <?= $this->Form->text(
                                'sns_facebook_url',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('URL of account. https://www.facebook.com/{{ account name }}'),
                                    'value' => $setting['sns_facebook_url']
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="twitter-x" class="form-label"><?= __('Twitter/X.com') ?></label>
                    <div class="row">
                        <div class="col-4">
                            <?= $this->Form->text(
                                'sns_twitter_name',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('Account name'),
                                    'value' => $setting['sns_twitter_name'],
                                ]
                            ) ?>
                        </div>
                        <div class="col">
                            <?= $this->Form->text(
                                'sns_twitter_url',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('URL of account. https://x.com/{{ account name }}'),
                                    'value' => $setting['sns_twitter_url'],
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="instagram" class="form-label"><?= __('Instagram') ?></label>
                    <div class="row">
                        <div class="col-4">
                            <?= $this->Form->text(
                                'sns_instagram_name',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('Account name'),
                                    'value' => $setting['sns_instagram_name'],
                                ]
                            ) ?>
                        </div>
                        <div class="col">
                            <?= $this->Form->text(
                                'sns_instagram_url',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('URL of account. https://instagram.com/{{ account name }}'),
                                    'value' => $setting['sns_instagram_url'],
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="tiktok" class="form-label"><?= __('Tiktok') ?></label>
                    <div class="row">
                        <div class="col-4">
                            <?= $this->Form->text(
                                'sns_tiktok_name',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('Account name'),
                                    'value' => $setting['sns_tiktok_name'],
                                ]
                            ) ?>
                        </div>
                        <div class="col">
                            <?= $this->Form->text(
                                'sns_tiktok_url',
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('URL of account. https://tiktok.com/{{ account name }}'),
                                    'value' => $setting['sns_tiktok_url'],
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>