<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
  <ul class="nav nav-underline">
    <li class="nav-item"><i class="bi bi-arrow-return-right nav-link disabled"></i></li>
    <li class="nav-item">
      <?= $this->Html->link(__('Dashboard'), '/manager/cms', ['class' => $subMenuActive === 'dashboard' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Posts'), '/manager/cms/posts', ['class' => $subMenuActive === 'posts' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Categoriey'), '/manager/cms/categories', ['class' => $subMenuActive === 'categories' ? 'nav-link active' : 'nav-link']) ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link(__('Tags'), '/manager/cms/tags', ['class' => $subMenuActive === 'tags' ? 'nav-link active' : 'nav-link']) ?>
    </li>
  </ul>
</nav>