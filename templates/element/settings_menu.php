<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="<?= $subMenuActive === 'system' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/system">
                            <span class="nav-link-title"><?= __('System') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'admin-users' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/admin-users">
                            <span class="nav-link-title"><?= __('Admin users') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'client_users' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/client-users">
                            <span class="nav-link-title"><?= __('Client users') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'roles' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/roles">
                            <span class="nav-link-title"><?= __('Roles') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>