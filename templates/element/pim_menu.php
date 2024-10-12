<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="<?= $subMenuActive === 'products' ? 'nav-item active' : 'nav-item' ?>">
                        <a class="nav-link" href="/manager/pim/products">
                            <span class="nav-link-title"><?= __('Products') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'families' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/pim/product-families" class="nav-link">
                            <span class="nav-link-title"><?= __('Families') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'categories' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/pim/product-categories" class="nav-link">
                            <span class="nav-link-title"><?= __('Categories') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'types' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/pim/product-types" class="nav-link">
                            <span class="nav-link-title"><?= __('Types') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>