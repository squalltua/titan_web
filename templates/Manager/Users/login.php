<?= $this->Form->create() ?>
    <h3 class="text-center"><?= __('TF Manager') ?></h3>
    <div class="mb-3">
        <h5 class="text-center"><?= __('Please login first.') ?></h5>
        <?= $this->Flash->render() ?>
    </div>

    <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Please enter you email.">
        <label for="floatingInput"><?= __('Email') ?></label>
    </div>
    <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Please enter you password.">
        <label for="floatingPassword"><?= __('Password') ?></label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit"><?= __('Sign-in') ?></button>
<?= $this->Form->end() ?>