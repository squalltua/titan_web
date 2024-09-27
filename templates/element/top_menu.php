<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="/office">TitanWEB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $applicationName ?? __('Application') ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/manager"><?= __('All') ?></a></li>
                <li><a class="dropdown-item" href="/manager/wcm/posts"><?= __('Web Content management') ?></a></li>
                <li><a class="dropdown-item" href="/manager/pim/products"><?= __('Product information management') ?></a></li>
                <li><a class="dropdown-item" href="/manager/dam/medias"><?= __('Digital assets management') ?></a></li>
                <li><a class="dropdown-item" href="/manager/crm/customers"><?= __('Customer data manangment') ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/manager/settings"><?= __('Settings management') ?></a></li>
            </ul>
            </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $this->Identity->get('username'); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/manager/settings/users/profile"><?= __('Profile') ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/manager/logout"><?= __('Logout') ?></a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>