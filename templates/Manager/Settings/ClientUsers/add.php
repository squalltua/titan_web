<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create new') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Client Users') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/settings/client-users/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?= $this->Form->create($user) ?>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= __('Client user information') ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="full-name" class="form-label required"><?= __('Full name') ?></label>
                            <?= $this->Form->text('full_name', ['class' => 'form-control', 'id' => 'full-name', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label required"><?= __('E-mail') ?></label>
                            <?= $this->Form->email('email', ['class' => 'form-control', 'id' => 'email', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="phone-number" class="form-label"><?= __('Phone number') ?></label>
                            <?= $this->Form->text('phone_number', ['class' => 'form-control', 'id' => 'phone-number']) ?>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label required"><?= __('Username') ?></label>
                            <?= $this->Form->text('username', ['class' => 'form-control', 'id' => 'username', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label required"><?= __('Password') ?></label>
                            <div class="input-group input-group-flat">
                                <?= $this->Form->password('password', ['class' => 'password-input form-control', 'autocomplete' => 'off', 'required' => true]) ?>
                                <span class="input-group-text">
                                    <span class="show-password link-secondary" data-bs-toggle="tooltip"
                                        aria-label="Show password" data-bs-original-title="Show password">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
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
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), '/manager/settings/client-users', ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary submit-btn ms-auto', 'disabled' => true]) ?>
                        </div>
                    </div>
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

let validationRegex = [{
        regex: /.{8,}/
    }, // min 8 letters,
    {
        regex: /[0-9]/
    }, // numbers from 0 - 9
    {
        regex: /[a-z]/
    }, // letters from a - z (lowercase)
    {
        regex: /[A-Z]/
    }, // letters from A-Z (uppercase),
    {
        regex: /[^A-Za-z0-9]/
    } // special characters
]

passwordInp.addEventListener('keyup', () => {
    validationRegex.forEach((item, i) => {
        let isValid = item.regex.test(passwordInp.value);

        if (isValid) {
            passwordChecklist[i].classList.add('checked');
        } else {
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