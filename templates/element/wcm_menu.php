<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="<?= $subMenuActive === 'posts' ? 'nav-item active' : 'nav-item px-3' ?>">
                        <?= $this->Html->link(__('Posts'), '/manager/wcm/posts', ['class' => $subMenuActive === 'posts' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(__('Groups'), '/manager/wcm/groups', ['class' => $subMenuActive === 'groups' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./">
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>