<nav class="navbar navbar-expand px-3 border-bottom bg-light-subtle">
    <button class="btn" id="sidebar-toggle" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse nav-bar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                    <h6 class="m-0 text-dark"><?= $this->Identity->get('full_name') ?> (<?= $this->Identity->get('role') ?>)</h6>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="/manager/logout" class="dropdown-item"><?= __('Sign-out') ?></a>
                </div>
            </li>
        </ul>
    </div>
</nav>