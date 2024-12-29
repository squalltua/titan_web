<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Index table') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Customers') ?>
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
    <?php if ($customers->count()): ?>
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-nowrap datatable">
                        <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('title') ?></th>
                            <th><?= $this->Paginator->sort('phone') ?></th>
                            <th><?= $this->Paginator->sort('email') ?></th>
                            <th><?= $this->Paginator->sort('contact_type', __('Type')) ?></th>
                            <th><?= $this->Paginator->sort('status') ?></th>
                            <th><?= __('Action') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= $customer->title ?></td>
                                <td><?= $customer->phone ?></td>
                                <td><?= $customer->email ?></td>
                                <td><?= $customer->contact_type ?></td>
                                <td><?= $customer->status ?></td>
                                <td>
                                    <?= $this->Html->link(
                                        __('View'),
                                        "/manager/cdm/customers/detail/{$customer->id}",
                                        ['class' => 'me-3']
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        __('Delete'),
                                        "/manager/cdm/customers/delete/{$customer->id}",
                                        ['class' => 'text-danger', 'confirm' => __('Do you want to delete this data?')],
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <ul class="pagination m-0">
                        <?= $this->Paginator->prev('« Previous') ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next('Next »') ?>
                    </ul>
                    <p class="m-0 ms-auto text-secondary"><?= $this->Paginator->counter('range'); ?></p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
                <div class="empty-img">
                    <?= $this->Html->image('undraw_blank_canvas_re_2hwy.svg', ['height' => 128]) ?>
                </div>
                <p class="empty-title"><?= __('No results found') ?></p>
                <p class="empty-subtitle text-secondary">
                    <?= __("Try adjusting your search or filter to find what you're looking for.") ?>
                </p>
                <div class="empty-action">
                    <a href="/manager/cdm/customers/add" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14"/>
                            <path d="M5 12l14 0"/>
                        </svg>
                        <?= __('Add your first customers') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
