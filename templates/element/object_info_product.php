<div class="card-header">
    <div>
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar" style="background-image: url()"></span>
            </div>
            <div class="col">
                <div class="card-title"><?= $product->title ?></div>
                <div class="card-subtitle"><?= $product->sku ?></div>
            </div>
        </div>
    </div>
    <div class="card-actions">
        <a href="<?= "/manager/pim/products/edit/{$product->id}" ?>" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                <path d="M16 5l3 3"/>
            </svg>
            <?= __('Edit') ?>
        </a>
    </div>
</div>
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <?= $this->Html->link(__('Basic information'), "/manager/pim/products/detail/{$product->id}", ['class' => $objectMenuActive === 'detail' ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Meta data'), "/manager/pim/products/meta/{$product->id}", ['class' => $objectMenuActive === 'meta' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Variants'), "/manager/pim/products/variants/{$product->id}", ['class' => $objectMenuActive === 'variants' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Images'), "/manager/pim/products/images/{$product->id}", ['class' => $objectMenuActive === 'images' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
    </ul>
</div>
