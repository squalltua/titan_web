<div class="card shadow-sm">
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