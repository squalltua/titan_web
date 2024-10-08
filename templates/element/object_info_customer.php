<div class="card-body">
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start">
            <a href="/manager/pim/products" class="btn btn-light me-4"><i class="bi bi-chevron-left"></i></a>
            <h3 class="m-0"><?= h($customer->title) ?></h3>
        </div>
        <div>
            <?= $this->Html->link(__('Edit'), "/manager/cdm/customers/edit/{$customer->id}", ['class' => 'btn btn-primary']) ?>
        </div>
    </div> 
</div>
<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
    <ul class="nav nav-underline">
        <li class="nav-item"><i class="bi bi-arrow-return-right nav-link px-3 disabled"></i></li>
        <li class="nav-item">
            <?= $this->Html->link(__('Detail'), "/manager/cdm/customers/detail/{$customer->id}", ['class' => $objectMenuActive === 'detail' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Contacts'), "/manager/cdm/customers/contacts/{$customer->id}", ['class' => $objectMenuActive === 'contacts' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Orders'), "/manager/cdm/customers/orders/{$customer->id}", ['class' => $objectMenuActive === 'orders' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link(__('Notes'), "/manager/cdm/customers/notes/{$customer->id}", ['class' => $objectMenuActive === 'notes' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
    </ul>
</nav>