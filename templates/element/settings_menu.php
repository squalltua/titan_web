<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
    <ul class="nav nav-underline">
        <li class="nav-item"><i class="bi bi-arrow-return-right nav-link disabled"></i></li>
        <li class="nav-item">
            <?= $this->Html->link(__('Dashboard'), '/manager/settings', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Users'), '/manager/settings/users', ['class' => $subMenuActive === 'users' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="name-item">
            <?= $this->Html->link(__('Roles'), '/manager/settings/roles', ['class' => $subMenuActive === 'roles' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('System'), '/manager/settings/system', ['class' => $subMenuActive === 'configurations' ? 'nav-link active' : 'nav-link']) ?>
        </li>
    </ul>
</nav>