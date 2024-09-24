<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Users :: New') ?></h4>
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
                <div class="form-group mb-3">
                    <label for="password" class="form-label"><?= __('Password') ?></label>
                    <?= $this->Form->password('password', ['class' => 'password-input form-control form-control-sm', 'id' => 'password', 'required' => true, 'value' => '']) ?>
                    <i class="show-password bi bi-eye px-2"></i>
                    <div id="password-help" class="form-text password-checklist">
                        <p class="checklist-title mb-1"><?= __('Password should be') ?></p>

                        <ul class="checklist">
                            <li class="list-item"><?= __('At least 8 character long') ?></li>
                            <li class="list-item"><?= __('At least 1 number') ?></li>
                            <li class="list-item"><?= __('At least 1 lowercase letter') ?></li>
                            <li class="list-item"><?= __('At least 1 uppercase letter') ?></li>
                            <li class="list-item"><?= __('At least 1 special character') ?></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary btn submit-btn', 'disabled' => true]) ?>
                    <?= $this->Html->link(__('Back'), "/manager/settings/users", ['class' => 'btn btn-secondary btn']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    // show password toggler
    let showPasswordBtn = document.querySelector('.show-password');
    let passwordInp = document.querySelector('.password-input');
    let submitBtn = document.querySelector('.submit-btn');

    showPasswordBtn.addEventListener('click', () => {
        // toggle icon
        // font awesome class for eye icon
        showPasswordBtn.classList.toggle('bi-eye');

        // font awesome class for slashed eye icon
        showPasswordBtn.classList.toggle('bi-eye-slash');

        // ternary operator a shorthand for if and else to change the type of password input
        passwordInp.type = passwordInp.type === 'password' ? 'text' : 'password';
    });

    // string password validation

    let passwordChecklist = document.querySelectorAll('.list-item');

    let validationRegex = [
        { regex: /.{8,}/ }, // min 8 letters,
        { regex: /[0-9]/ }, // numbers from 0 - 9
        { regex: /[a-z]/ }, // letters from a - z (lowercase)
        { regex: /[A-Z]/}, // letters from A-Z (uppercase),
        { regex: /[^A-Za-z0-9]/} // special characters
    ]

    passwordInp.addEventListener('keyup', () => {
        validationRegex.forEach((item, i) => {
            let isValid = item.regex.test(passwordInp.value);

            if(isValid) {
                passwordChecklist[i].classList.add('checked');
            } else{
                passwordChecklist[i].classList.remove('checked');
            }

            if (document.querySelectorAll('li.checked').length === 5) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', true);
            }
        });
    });
</script>