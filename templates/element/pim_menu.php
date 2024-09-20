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
            <?= $this->Html->link(__('Families'), '/manager/pim/product-families', ['class' => $subMenuActive === 'families' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Categories'), '/manager/pim/product-categories', ['class' => $subMenuActive === 'categories' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Types'), '/manager/pim/product-types', ['class' => $subMenuActive === 'types' ? 'nav-link active' : 'nav-link']) ?>
        </li>
    </ul>
</nav>
