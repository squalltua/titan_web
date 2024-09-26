<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Posts :: New') ?></h4>
            </div>
        </div>

        <?= $this->Form->create($post, ['type' => 'file']) ?>
        <div class="row">
            <div class="col">
                <div class="form-group mb-3">
                    <label for="title" class="form-label"><?= __('Title') ?></label>
                    <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label"><?= __('Content (Markdown syntex supported)') ?></label>
                    <?= $this->Form->textarea(
                        'content',
                        [
                            'class' => 'form-control',
                            'id' => 'content',
                            'rows' => '10',
                            'style' => "width:100%; height:500px",
                        ]
                    ) ?>
                    <div id="emailHelp" class="form-text"><?= __('The content box is supported Markdown syntext. We recommened use Markdown.') ?></div>
                </div>
                <div class="form-group mb-3">
                    <label for="meta-posts-og-tag-title" class="form-label"><?= __('OG Tag Title') ?></label>
                    <?= $this->Form->text('meta_posts.og_tag_title', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-title']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="meta-posts-og-tag-description" class="form-label"><?= __('OG Tag description') ?></label>
                    <?= $this->Form->textarea('meta_posts.og_tag_description', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-description']) ?>
                    <div id="emailHelp" class="form-text"><?= __('Only text for short description for display another plateform.') ?></div>
                </div>
                <div class="form-group mb-3">
                    <label for="meta-posts-og-tag-image" class="form-label"><?= __('OG Tag image') ?></label>
                    <?= $this->Form->file('meta_posts.og_tag_image', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-image']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="meta-posts-og-tag-url" class="form-label"><?= __('OG Tag URL') ?></label>
                    <?= $this->Form->text('meta_posts.og_tag_url', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-url']) ?>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mb-3">
                    <label for="status" class="form-label"><?= __('Status') ?></label>
                    <?= $this->Form->select(
                        'status',
                        [
                            'draft' => __('Draft'),
                            'published' => __('Published'),
                            'unpublished' => __('Unpublished')
                        ],
                        ['class' => 'form-select', 'id' => 'status']
                    ) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="intro" class="form-label"><?= __('Intro') ?></label>
                    <?= $this->Form->textarea('intro', ['class' => 'form-control']) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="post-groups-ids" class="form-label"><?= __('Groups') ?></label>
                    <?= $this->Form->select(
                        'post_groups._ids',
                        $postGroups,
                        [
                            'class' => 'form-select',
                            'id' => 'post-groups-ids',
                            'multiple' => true
                        ]
                    ) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="feature-image" class="form-label"><?= __('Feature image') ?></label>
                    <?= $this->Form->file('meta_posts.feature_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary me-md-2']) ?>
                <?= $this->Html->link(__('Back'), "/manager/wcm/posts", ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>