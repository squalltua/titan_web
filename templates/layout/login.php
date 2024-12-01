<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sing-in to TITAN/WEB</title>
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
<body class="d-flex flex-column">
<div class="page page-center">
    <div class="container container-normal py-4">
        <?= $this->fetch('content') ?>
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
