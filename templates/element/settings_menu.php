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
                    <li class="<?= $subMenuActive === 'admin_users' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/admin-users">
                            <span class="nav-link-title"><?= __('Admin users') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'roles' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/settings/roles">
                            <span class="nav-link-title"><?= __('Roles') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'languages' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/settings/languages" class="nav-link">
                            <span class="nav-link-title"><?= __('Languages') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'published' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/settings/published" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                <path d="M9 15l3 -3l3 3" />
                                <path d="M12 12l0 9" />
                            </svg>
                            <span class="nav-link-title ms-2"><?= __('Published') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>