<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <?= __('Posts') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <?= $this->Html->link(__('New'), '/manager/wcm/posts/add', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th style="width: 150px"><?= $this->Paginator->sort('status') ?></th>
                    <th style="width: 150px"><?= $this->Paginator->sort('created') ?></th>
                    <th style="width: 150px"><?= $this->Paginator->sort('modified') ?></th>
                    <th style="width: 250px"><?= __('Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= h($post->title) ?></td>
                    <td><?= h($post->status) ?></td>
                    <td><?= $this->Time->format($post->created) ?></td>
                    <td><?= $this->Time->format($post->modified) ?></td>
                    <td>
                        <?= $this->Html->link(__('Detail'), "/manager/wcm/posts/view/{$post->id}", ['class' => 'me-3']) ?>
                        <?= $this->Html->link(__('Edit'), "/manager/wcm/posts/edit/{$post->id}", ['class' => 'me-3']) ?>
                        <?= $this->Form->postLink(__('Delete'), "/manager/wcm/posts/delete/{$post->id}") ?>
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