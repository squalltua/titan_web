<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Create new') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Posts group') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/wcm/groups/add" class="btn btn-primary d-none d-sm-inline-block">
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
        <?= $this->Form->create($group) ?>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= __('Group information') ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required"><?= __('Name') ?></label>
                            <?= $this->Form->text('name', ['class' => 'form-control', 'id' => 'name', 'oninput' => 'listingslug(this.value)', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label required"><?= __('Slug') ?></label>
                            <?= $this->Form->text('slug', ['class' => 'form-control', 'id' => 'slug', 'required' => true]) ?>
                            <div id="emailHelp" class="form-text">
                                <?= __('slug is the same as name but is all lowercase. For example, Post-groups will be post-groups.') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label"><?= __('Content') ?></label>
                            <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), '/manager/wcm/posts', ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    function listingslug(text) {
        document.getElementById("slug").value = slugify(text);
    }
</script>
