<!DOCTYPE html>
<html class="h-100">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | Online Office system</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        // '/vendor/bootstrap-5.3.3/css/bootstrap.min.css',
        // '/vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css',
        // '/vendor/bootstrap-5.3.3/css/bootstrap.min.css',
        'dist/css/tabler.min.css',
        'dist/css/tabler-flags.min.css',
        'dist/css/tabler-payments.min.css',
        'dist/css/tabler-vendors.min.css',
        'dist/css/demo.min.css',
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

<body class="d-flex flex-column bg-body-tertiary h-100">
    <?= $this->element('top_menu') ?>
    <?= $this->element($subMenu ?? 'submenu_default') ?>
    <main class="container-fluid">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
    <footer class="footer mt-auto">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center py-3">
            <p class="col-md-4 mb-0 text-body-secondary">© <?= date('Y') ?> Titansacript business consult co.,ltd.</p>
            <p class="col-md-4 mb-0 text-body-secondary text-end">Version 1.0</p>
        </div>
    </footer>
    <?= $this->Html->script([
        '/vendor/bootstrap-5.3.3/js/bootstrap.bundle.min.js',
        'component.js',
        'main.js',
    ]) ?>
</body>

</html>