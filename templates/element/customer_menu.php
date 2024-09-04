<nav class="container-fluid bg-white shadow-sm mb-3">
  <ul class="nav nav-underline">
    <li class="nav-item">
      <?= $this->Html->link(__('Dashboard'), '/office/customers', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('List'), 'office/customers/list', ['class' => $subMenuActive === 'list' ? 'nav-link active' : 'nav-link']) ?>
    </li>
  </ul>
</nav>