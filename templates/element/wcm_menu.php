<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="<?= $subMenuActive === 'posts' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/wcm/posts">
                            <span class="nav-link-title"><?= __('Posts') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'groups' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/wcm/groups" class="nav-link">
                            <span class="nav-link-title"><?= __('Groups') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'languages' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/wcm/languages" class="nav-link">
                            <span class="nav-link-title"><?= __('Languages') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'published' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/wcm/published" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                <path d="M9 15l3 -3l3 3" />
                                <path d="M12 12l0 9" />
                            </svg>
                            <span class="nav-link-title ms-2"><?= __('Publishers') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>