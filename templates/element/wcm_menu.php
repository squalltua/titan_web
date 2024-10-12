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
                </ul>
            </div>
        </div>
    </div>
</header>