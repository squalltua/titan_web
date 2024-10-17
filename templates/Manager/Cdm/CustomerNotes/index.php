<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Customer') ?>
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
    <div class="container-xl">
        <div class="card">
            <?= $this->element('object_info_customer') ?>
            <div class="card-body">
                <?= $this->Html->link(__('New note'), "/manager/cdm/customers/notes/{$customer->id}/add", ['class' => 'btn btn-primary mb-3']) ?>
                <?php if ($notes->count()): ?>
                    <?php foreach ($notes as $note): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $note->title ?></h5>
                                <p class="card-text"><?= $note->content ?></p>
                                <?= $this->Html->link(
                                    __('Edit'),
                                    "/manager/cdm/customers/notes/{$customer->id}/edit/{$note->id}",
                                    ['class' => 'card-link me-3']
                                ) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    "/manager/cdm/customers/notes/{$customer->id}/delete/{$note->id}",
                                    [
                                        'class' => 'card-link text-danger',
                                        'confirm' => __('Do you want to delete this data?')
                                    ]
                                ) ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="p-2 mb-4">
                        <div class="container-fluid py-5 text-muted text-center">
                            <h1 class="display-5 text-center"><?= __('No data') ?></h1>
                            <p class="fs-4 text-center"><?= __('Please insert first') ?></p>
                            <?= $this->Html->link(__('New'), "/manager/cdm/customers/notes/{$customer->id}/add", ['class' => 'btn btn-secondary btn-lg ms-3']) ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
