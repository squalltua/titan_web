<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Index table') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Client Users') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/settings/client-users/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
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
    <div class="container-xl mb-3">
        <?= $this->Form->create(null, ['type' => 'get', 'id' => 'search-tool']) ?>
        <div class="d-flex">
            <div class="text-secondary">
                <?= __('Show') ?>
                <div class="mx-2 d-inline-block">
                    <?= $this->Form->select(
                        'show_entries', 
                        [25 => 25, 50 => 50, 100 => 100], 
                        [
                            'value' => $this->request->getQuery('show_entries'), 
                            'class' => 'form-select', 'onchange' => 'this.form.submit()'
                        ]
                    ) ?>
                </div>
                <?= __('entries') ?>
            </div>
            <div class="ms-auto text-secondary">
                <?= __('Full name search') ?>:
                <div class="ms-2 d-inline-block">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" name="keyword" id="keyword"
                            value="<?= $this->request->getQuery('keyword') ?>" onchange="this.form.submit()">
                        <span class="input-group-text">
                            <a href="#!" class="link-secondary" title="Clear search" data-bs-toggle="tooltip"
                                onclick="document.getElementById('keyword').value = '';">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <?php if ($users->count()): ?>
    <div class="container-xl">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-nowrap datatable">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('full_name') ?></th>
                            <th><?= $this->Paginator->sort('email') ?></th>
                            <th><?= $this->Paginator->sort('username') ?></th>
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
                            <td><?= h($user->status) ?></td>
                            <td><?= $this->Time->format($user->modified, "dd/MM/YYYY") ?>
                            <td>
                                <?= $this->Html->link(__('Edit'), "/manager/settings/client-users/edit/{$user->id}", ['class' => 'me-3']) ?>
                                <?= $this->Form->postLink(__('Delete'), "/manager/settings/client-users/delete/{$user->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this account?')]) ?>
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
                <a href="/manager/settings/client-users/add" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    <?= __('Add your first users') ?>
                </a>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>