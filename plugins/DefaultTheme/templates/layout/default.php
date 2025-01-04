<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        '../vendor/bootstrap-5.3.3/css/bootstrap.min.css',
        'https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap',
        'default.css',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?= $this->element('header') ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <?= $this->element('footer') ?>
    <?= $this->Html->script([
        '../vendor/bootstrap-5.3.3/js/bootstrap.bundle.min.js',
        'default.js'
    ]) ?>
</body>

</html>