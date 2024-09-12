<div class="row">
    <div class="col">
        <h4>
            <?= __('Post groups') ?>
            <?= $this->Html->link(__('New'), '/manager/cms/groups/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('content') ?></th>
                    <th><?= __('Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $group): ?>
                    <tr>
                        <td><?= h($group->name) ?></td>
                        <td><?= h($group->slug) ?></td>
                        <td><?= h($group->content) ?></td>
                        <td>
                            <?= $this->Html->link(__('Edit'), "/manager/cms/groups/edit/{$group->id}", ['class' => 'me-3']) ?>
                            <?= $this->Form->postLink(__('Delete'), "/manager/cms/groups/delete/{$group->id}") ?>
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