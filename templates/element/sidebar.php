<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="/manager"><?= __('TF Manager') ?></a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <i class="bi bi-body-text pe-2"></i><?= __('Posts') ?>
            </li>
            <li class="sidebar-item ms-3">
                <?= $this->Html->link(__('All posts'), '/manager/posts', ['class' => $menuActive === 'posts' ? 'sidebar-link active' : 'sidebar-link']) ?>
            </li>
            <li class="sidebar-item ms-3">
                <?= $this->Html->link(__('Categories'), '/manager/posts/categories', ['class' => $menuActive === 'post-categories' ? 'sidebar-link active' : 'sidebar-link']) ?>
            </li>
            <li class="sidebar-item ms-3">
                <?= $this->Html->link(__('Tags'), '/manager/posts/tags', ['class' => $menuActive === 'post-tags' ? 'sidebar-link active' : 'sidebar-link']) ?>
            </li>

            <li class="sidebar-header">
                <i class="bi bi-gear pe-2"></i><?= __('Settings') ?>
            </li>
            <li class="sidebar-item ms-3">
                <?= $this->Html->link(__('System'), '/manager/system', ['class' => $menuActive === 'system' ? 'sidebar-link active' : 'sidebar-link']) ?>
            </li>
            <li class="sidebar-item ms-3">
                <?= $this->Html->link(__('Users'), '/manager/users', ['class' => $menuActive === 'users' ? 'sidebar-link active' : 'sidebar-link']) ?>
            </li>
        </ul>
    </div>
</aside>
