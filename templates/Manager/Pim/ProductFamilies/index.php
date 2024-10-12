<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Index table') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Product Families') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/pim/product-families/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <line x1="12" y1="5" x2="12" y2="19" />
                      <line x1="5" y1="12" x2="19" y2="12" />
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
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-nowrap datatable">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('name') ?></th>
                            <th><?= $this->Paginator->sort('description') ?></th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($families->count()): ?>
                        <?php foreach ($families as $family): ?>
                            <tr>
                                <td><?= h($family->name) ?></td>
                                <td><?= h($family->description) ?></td>
                                <td class="text-end">
                                    <?= $this->Html->link(__('Edit'), "/manager/pim/product-families/edit/{$family->id}", ['class' => 'me-3']) ?>
                                    <?= $this->Form->postLink(__('Delete'), "/manager/pim/product-families/delete/{$family->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this data?')]) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center"><?= __('No data') ?></td>
                            </tr>
                        <?php endif ?>
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
</div>