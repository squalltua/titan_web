<div class="row">
    <div class="col">
        <h4>
            <?= __('Customers') ?>
            <?= $this->Html->link(__('New'), '/manager/cdm/customers/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <?php if ($customers->count()): ?>
        <table class="table table-bordered bg-white">
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
                                "/manager/cdm/customers/view/{$customer->id}",
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
        <div class="d-flex justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?= $this->Paginator->prev('« Previous') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('Next »') ?>
                </ul>
            </nav>
            <div>
                <?= $this->Paginator->counter('range'); ?>
            </div>
        </div>
        <?php else: ?>
            <div class="p-2 mb-4">
                <div class="container-fluid py-5 text-muted text-center">
                    <h1 class="display-5 text-center"><?= __('No data') ?></h1>
                    <p class="fs-4 text-center"><?= __('Please insert first') ?></p>
                    <?= $this->Html->link(__('New'), '/manager/cdm/customers/add', ['class' => 'btn btn-secondary btn-lg ms-3']) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>