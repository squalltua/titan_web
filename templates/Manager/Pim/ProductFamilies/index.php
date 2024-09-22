<div class="row">
    <div class="col">
        <h4>
            <?= __('Product Families') ?>
            <?= $this->Html->link(__('New'), '/manager/pim/product-families/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <?php if ($families->count()): ?>
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= __('Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($families as $family): ?>
                    <tr>
                        <td><?= h($family->name) ?></td>
                        <td><?= h($family->description) ?></td>
                        <td>
                            <?= $this->Html->link(__('Edit'), "/manager/pim/product-families/edit/{$family->id}", ['class' => 'me-3']) ?>
                            <?= $this->Form->postLink(__('Delete'), "/manager/pim/product-families/delete/{$family->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this data?')]) ?>
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
                    <?= $this->Html->link(__('New'), '/manager/pim/product-families/add', ['class' => 'btn btn-secondary btn-lg ms-3']) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>