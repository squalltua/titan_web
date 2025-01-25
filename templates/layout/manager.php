<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | Online Office system</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        '/vendor/tabler-v1.0.0-beta20/dist/css/tabler.min.css',
        '/vendor/tabler-v1.0.0-beta20/dist/css/tabler-flags.min.css',
        '/vendor/tabler-v1.0.0-beta20/dist/css/tabler-payments.min.css',
        '/vendor/tabler-v1.0.0-beta20/dist/css/tabler-vendors.min.css',
        'main.css',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="layout-fluid">
    <div class="page">
        <div class="sticky-top">
            <?= $this->element('header') ?>
            <?= $this->element($subMenu ?? 'submenu_default') ?>
        </div>
        <div class="page-wrapper">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" class="link-secondary" rel="noopener"><?= __('Documentation') ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; <?= date('Y') ?> Titan/WEB Open source. MIT LC.
                                </li>
                                <li class="list-inline-item">
                                    Version 1.0.0 (beta)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    <?= $this->Html->script([
        // Tabler Core
        '/vendor/tabler-v1.0.0-beta20/dist/js/tabler.min.js',

        // TitanWEB Core
        'component.js',
        'main.js',
    ]) ?>
</body>

</html>