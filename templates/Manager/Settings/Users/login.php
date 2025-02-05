<div class="row align-items-center g-4">
    <div class="col-lg">
        <div class="container-tight">
            <div class="text-center mb-4">
                <h1>TITAN/WEB</h1>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4"><?= __('Login to your account') ?></h2>
                    <?= $this->Form->create(null, ['autocomplete' => 'off', 'onvalidate' => true]) ?>
                    <div class="mb-3">
                        <label for="email" class="form-label"><?= __('Email address') ?></label>
                        <input name="email" id="email" type="email" class="form-control" placeholder="your@email.com"
                               autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">
                            <?= __('Password') ?>
                        </label>
                        <div class="input-group input-group-flat">
                            <input name="password" id="password" type="password" class="form-control"
                                   placeholder="Your password"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100"><?= __('Sign in') ?></button>
                    </div>
                    <?= $this->Form->end() ?>
                    <div class="row">
                        <div class="col">
                            <?= $this->Flash->render() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg d-none d-lg-block">
        <?= $this->Html->image('/vendor/tabler-v1.0.0-beta20/static/illustrations/undraw_secure_login_pdn4.svg', ['height' => 300, 'class' => 'd-block mx-auto', 'alt' => '']) ?>
    </div>
</div>
