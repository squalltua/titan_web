<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Edit information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Medias') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/dam/medias/add" class="btn btn-primary d-none d-sm-inline-block">
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
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <?= $this->Html->image($media->link_url, ['class' => 'img-fluid']) ?>
                        <div class="datagrid mt-3">
                            <div class="datagrid-item">
                                <div class="datagrid-title"><?= __('File name') ?></div>
                                <div class="datagrid-contentt"><?= $media->filename ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title"><?= __('Mime') ?></div>
                                <div class="datdagrid-content"><?= $media->mime ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title"><?= __('Size') ?></div>
                                <div class="datagride-content"><?= $this->Number->toReadableSize($media->size) ?></div>
                            </div>
                            <div class="datagrid-itme">
                                <div class="datagrid-title"><?= __('Using type') ?></div>
                                <div class="datagrid-content"><?= $media->using_type ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title"><?= __('Created') ?></div>
                                <div class="datagrid-content"><?= $media->created->i18nFormat('dd/mm/yyyy hh:mm:ss') ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title"><?= __('Modified') ?></div>
                                <div class="datagrid-content"><?= $media->modified->i18nFormat('dd/mm/yyyy hh:mm:ss') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <?= $this->Form->create($media) ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= __('Media information') ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label"><?= __('Description') ?></label>
                                    <?= $this->Form->text('title', ['class' => 'form-control']) ?>
                                </div>
                                <div class="mb-3">
                                    <label for="descreiption" class="form-label"><?= __('Description') ?></label>
                                    <?= $this->Form->textarea('description', ['class' => 'form-control']) ?>
                                </div>
                                <div class="mb-3">
                                    <label for="alt" class="form-label"><?= __('alt') ?></label>
                                    <?= $this->Form->text('alt', ['class' => 'form-control']) ?>
                                </div>
                                <div class="mb-3">
                                    <label for="order-index" class="form-label"><?= __('Order index') ?></label>
                                    <?= $this->Form->text('order_index', ['class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <?= $this->Html->link(__('Cancel'), '/manager/dam/medias', ['class' => 'btn btn-link']) ?>
                                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
