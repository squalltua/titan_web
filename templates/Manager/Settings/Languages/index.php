<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Index table') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Languages') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/settings/languages/add" class="btn btn-primary d-none d-sm-inline-block">
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
    <?php if ($languages->count()): ?>
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-nowrap datatable">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('unicode') ?></th>
                                <th><?= __('Default') ?></th>
                                <th><?= __('Action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($languages as $language): ?>
                                <tr>
                                    <td><?= h($language->title) ?></td>
                                    <td><?= h($language->unicode) ?></td>
                                    <td><?= $language->is_default ? '&#x2713;' : '' ?></td>
                                    <td>
                                        <?= $this->Html->link(__('Edit'), "/manager/settings/languages/edit/{$language->id}", ['class' => 'me-3']) ?>
                                        <?= $this->Form->postLink(__('Delete'), "/manager/settings/languages/delete/{$language->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this data?')]) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
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
                    <a href="/manager/wcm/languages/add" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14"/>
                            <path d="M5 12l14 0"/>
                        </svg>
                        <?= __('Add your first language') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>