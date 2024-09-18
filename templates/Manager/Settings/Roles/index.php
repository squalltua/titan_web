<div class="row">
    <div class="col">
        <h4>
            <?= __('Roles') ?>
            <?= $this->Html->link(__('New'), '/manager/settings/roles/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title', __('Role')) ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('modified', __('Last modified')) ?></th>
                    <th><?= __('Action') ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= h($role->title) ?></td>
                        <td><?= h($role->description) ?></td>
                        <td><?= h($role->status) ?></td>
                        <td><?= $this->Time->format($role->modified, "dd/MM/YYYY") ?>
                        <td>
                            <?= $this->Html->link(__('Edit'), "/manager/settings/roles/edit/{$role->id}", ['class' => 'me-3']) ?>
                            <?= $this->Form->postLink(__('Delete'), "/manager/settings/roles/delete/{$role->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this role?')]) ?>
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
    </div>
</div>