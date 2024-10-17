<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Customer') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/cdm/customers/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <?= $this->element('object_info_customer') ?>
            <div class="card-body">
                <div class="datagrid">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Customer name') ?></div>
                        <div class="datagrid-content"><?= $customer->title ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Type') ?></div>
                        <div class="datagrid-content"><?= $customer->type ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Phone') ?></div>
                        <div class="datagrid-content"><?= $customer->phone ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Email') ?></div>
                        <div class="datagrid-content"><?= $customer->email ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Address') ?></div>
                        <div class="datagrid-content">
                            <?= $customer->address_line_1 ?><br/>
                            <?= $customer->address_line_2 ?><br/>
                            <?= "{$customer->city}, {$customer->province}" ?><br/>
                            <?= "{$customer->postcode}, {$customer->country}" ?>
                        </div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Contact type') ?></div>
                        <div class="datagrid-content"><?= $customer->contact_type ?></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title"><?= __('Service type') ?></div>
                        <div class="datagrid-content"><?= $customer->service_type ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
