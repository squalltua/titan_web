<div class="card-header">
    <div>
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar" style="background-image: url()"></span>
            </div>
            <div class="col">
                <div class="card-title"><?= $customer->title ?></div>
                <div class="card-subtitle"><?= __('Email: {0} Phone: {1}', $customer->email, $customer->phone) ?></div>
            </div>
        </div>
    </div>
    <div class="card-actions">
        <a href="<?= "/manager/cdm/customers/edit/{$customer->id}" ?>" class="btn">
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
</div>
