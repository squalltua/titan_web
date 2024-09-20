<nav class="container-fluid bg-white shadow-sm mb-3">
    <ul class="nav nav-underline">
        <li class="nav-item">
            <?= $this->Html->link(__('Dashboard'), '/manager/crm', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Customer'), '/manager/crm/customers', ['class' => $subMenuActive === 'list' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Groups'), '/manager/crm/groups', ['class' => $subMenuActive === 'groups' ? 'nav-link active' : 'nav-link']) ?>
        </li>
    </ul>
</nav>