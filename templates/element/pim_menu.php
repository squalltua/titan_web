<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
  <ul class="nav nav-underline">
    <li class="nav-item"><i class="bi bi-arrow-return-right nav-link disabled"></i></li>
    <li class="nav-item">
      <?= $this->Html->link(__('Dashboard'), '/manager/pim', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Products'), '/manager/pim/products', ['class' => $subMenuActive === 'products' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Groups'), '/manager/pim/groups', ['class' => $subMenuActive === 'groups' ? 'nav-link active' : 'nav-link']) ?>
    </li>
  </ul>
</nav>