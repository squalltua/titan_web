<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= __('Manager | TF Manager Titanscript business consult co.,ltd.') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css([
        '/vendor/bootstrap-5.3.3/css/bootstrap.min.css',
        '/vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css',
        '/vendor/kendoui.for.jquery.2024.1.130/styles/bootstrap-main.css',
        'main.css',
    ]) ?>

    <?= $this->Html->script([
        'jquery-3.7.0.min.js',
        '/vendor/bootstrap-5.3.3/js/bootstrap.bundle.min.js',
        '/vendor/kendoui.for.jquery.2024.1.130/js/kendo.all.min.js',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div class="wrapper">
    <?= $this->element('sidebar') ?>
    <div class="main">
        <?= $this->element('header') ?>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
        <?= $this->element('footer') ?>
    </div>
</div>
<?= $this->Html->script('main.js') ?>
</body>
</html>
