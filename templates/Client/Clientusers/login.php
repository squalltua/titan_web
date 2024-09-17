<div class="container">
    <div class="row justify-content-md-center mb-3">
        <div class="col-4 col-md-auto">
            <div class="card">
                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <div class="mb-3">
                        <h5 class="text-center"><?= __('Please login first.') ?></h5>
                    </div>

                    <?= $this->Flash->render() ?>

                    <div class="form-group mb-3">
                        <label for="floatingInput"><?= __('Email') ?></label>
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Please enter you email.">
                    </div>
                    <div class="form-group mb-3">
                        <label for="floatingPassword"><?= __('Password') ?></label>
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Please enter you password.">
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit"><?= __('Sign-in') ?></button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>