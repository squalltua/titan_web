<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
    <ul class="nav nav-underline">
        <li class="nav-item"><i class="bi bi-arrow-return-right nav-link disabled"></i></li>
        <li class="nav-item">
            <?= $this->Html->link(__('Detail'), "/manager/pim/products/detail/{$product->id}", ['class' => $objectMenuActive === 'detail' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Attributes'), "/manager/pim/products/attributes/{$product->id}", ['class' => $objectMenuActive === 'attributes' ? 'nav-link active' : 'nav-link']) ?>
        </li>
    </ul>
</nav>