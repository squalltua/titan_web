<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
    <ul class="nav nav-underline">
        <li class="nav-item"><i class="bi bi-arrow-return-right nav-link px-3 disabled"></i></li>
        <li class="nav-item">
            <?= $this->Html->link(__('Users'), '/manager/settings/users', ['class' => $subMenuActive === 'users' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="name-item">
            <?= $this->Html->link(__('Roles'), '/manager/settings/roles', ['class' => $subMenuActive === 'roles' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('System'), '/manager/settings/system', ['class' => $subMenuActive === 'configurations' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
    </ul>
</nav>