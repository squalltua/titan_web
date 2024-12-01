<header class="navbar navbar-expand-md sticky-top d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/manager">
                TITAN/WEB                
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url()"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= $this->Identity->get('full_name'); ?></div>
                        <div class="mt-1 small text-secondary"><?= $this->Identity->get('username'); ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="/manager/logout" class="dropdown-item"><?= __('Logout') ?></a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-baseline-density-small">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 3h16"/>
                                    <path d="M4 9h16"/>
                                    <path d="M4 15h16"/>
                                    <path d="M4 21h16"/>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                <?= $applicationName ?? __('Application') ?>
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/manager">
                                <?= __('All') ?>
                            </a>
                            <a class="dropdown-item" href="/manager/wcm/posts">
                                <?= __('Web Content management') ?>
                            </a>
                            <a class="dropdown-item" href="/manager/pim/products">
                                <?= __('Product information management') ?>
                            </a>
                            <a class="dropdown-item" href="/manager/dam/medias">
                                <?= __('Digital assets management') ?>
                            </a>
                            <a class="dropdown-item" href="/manager/cdm/customers">
                                <?= __('Customer data manangment') ?>
                            </a>
                            <a class="dropdown-item" href="/manager/settings/system">
                                <?= __('Site setting and System') ?>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
