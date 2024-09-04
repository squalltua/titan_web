<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
  <ul class="nav nav-underline">
    <li class="nav-item"><i class="bi bi-arrow-return-right nav-link disabled"></i></li>
    <li class="nav-item">
      <?= $this->Html->link(__('Dashboard'), '/manager/crm', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Posts'), '/manager/crm/posts', ['class' => $subMenuActive === 'posts' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Categoriey'), '/manager/crm/posts/categories', ['class' => $subMenuActive === 'post-categories' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Tags'), '/manager/crm/posts/tags', ['class' => $subMenuActive === 'post-tags' ? 'nav-link active' : 'nav-link']) ?>
    </li>
  </ul>
</nav>