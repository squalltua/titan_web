<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | Online Office system</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        '/vendor/bootstrap-5.3.3/css/bootstrap.min.css',
        '/vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css',
        '/vendor/bootstrap-5.3.3/css/bootstrap.min.css',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="bg-body-tertiary">
    <?= $this->element('top_menu') ?>
    <?= $this->element($subMenu ?? 'submenu_default') ?>
    <main class="container-fluid">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>
    <?= $this->Html->script(['/vendor/bootstrap-5.3.3/js/bootstrap.bundle.min.js']) ?>
</body>

</html>