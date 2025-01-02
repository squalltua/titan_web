<!DOCTYPE html>
<html class="h-100">

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
    <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
    </style>

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
                                <li class="list-inline-item"><a href="#" target="_blank" class="link-secondary"
                                        rel="noopener">Documentation</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; <?= date('Y') ?>
                                    <a href="https://www.titanscript.com" class="link-secondary">Titanscript business
                                        consult col.,ltd</a>.
                                    All rights reserved.
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