<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Post tags :: Edit') ?></h4>
            </div>
        </div>

        <?= $this->Form->create($tag) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="name" class="form-label"><?= __('Name') ?></label>
                    <?= $this->Form->text('name', ['class' => 'form-control', 'id' => 'name', 'oninput' => 'listingslug(this.value)']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="slug" class="form-label"><?= __('Slug') ?></label>
                    <?= $this->Form->text('slug', ['class' => 'form-control', 'id' => 'slug']) ?>
                    <div id="emailHelp" class="form-text"><?= __('slug is the same as name but is all lowercase. For example, Post-categories will be post-categories.') ?></div>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label"><?= __('Content') ?></label>
                    <?= $this->Form->textarea('content', ['class' => 'form-control', 'id' => 'content']) ?>
                </div>
                <div class="mt-4">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary btn']) ?>
                    <?= $this->Html->link(__('Cancel'), "/manager/cms/tags", ['class' => 'btn btn-secondary btn']) ?>
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