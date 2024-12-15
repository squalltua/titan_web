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
                    <li class="<?= $subMenuActive === 'categories' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/pim/categories" class="nav-link">
                            <span class="nav-link-title"><?= __('Categories') ?></span>
                        </a>
                    </li>
                    <li class="<?= $subMenuActive === 'variants' ? 'nav-item active' : 'nav-item' ?>">
                        <a href="/manager/pim/variants" class="nav-link">
                            <span class="nav-link-title"><?= __('Variant options') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>