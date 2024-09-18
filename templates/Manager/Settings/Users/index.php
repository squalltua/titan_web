<div class="row">
    <div class="col">
        <h4>
            <?= __('Users') ?>
            <?= $this->Html->link(__('New'), '/manager/settings/users/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('modified', __('Last modified')) ?></th>
                    <th><?= __('Action') ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= h($user->full_name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->role->title) ?></td>
                        <td><?= h($user->status) ?></td>
                        <td><?= $this->Time->format($user->modified, "dd/MM/YYYY") ?>
                        <td>
                            <?= $this->Html->link(__('Edit'), "/manager/settings/users/edit/{$user->id}", ['class' => 'me-3']) ?>
                            <?= $this->Form->postLink(__('Delete'), "/manager/settings/users/delete/{$user->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this account?')]) ?>
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