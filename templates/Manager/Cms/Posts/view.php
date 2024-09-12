<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Posts :: Information') ?></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-9">
                <h1 class="display-4"><?= h($post->title) ?></h1>
                <div class="form-group mb-3">
                    <div class="border p-3 conent-display">
                        <?= $post->content_display ?>
                    </div>
                </div>
                <div class="border p-3 mb-3">
                    <div class="form-group mb-3">
                        <label for="meta-posts-og-tag-title" class="form-label"><?= __('OG Tag Title') ?></label>
                        <?= $this->Form->text(
                            'meta_posts.og_tag_title',
                            [
                                'class' => 'form-control-plaintext',
                                'id' => 'meta-posts-og-tag-title',
                                'readonly' => true,
                                'value' => $post->meta['og_tag_title'] ?? '',
                            ]
                        ) ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta-posts-og-tag-description" class="form-label"><?= __('OG Tag description') ?></label>
                        <?= $this->Form->textarea(
                            'meta_posts.og_tag_description',
                            [
                                'class' => 'form-control-plaintext',
                                'id' => 'meta-posts-og-tag-description',
                                'readonly' => true,
                                'value' => $post->meta['og_tag_description'] ?? ''
                            ]
                        ) ?>
                        <div id="emailHelp" class="form-text"><?= __('Only text for short description for display another plateform.') ?></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta-posts-og-tag-image" class="form-label"><?= __('OG Tag image') ?></label>
                        <?php if (empty($post->meta['og_tag_image'])): ?>
                            <p><?= __('- No image -') ?></p>
                        <?php else: ?>
                            <?= $this->Html->image($post->meta['og_tag_image'], ['class' => 'img-fluid']) ?>
                        <?php endif ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta-posts-og-tag-url" class="form-label"><?= __('OG Tag URL') ?></label>
                        <?= $this->Form->text(
                            'meta_posts.og_tag_url',
                            [
                                'class' => 'form-control-plaintext',
                                'id' => 'meta-posts-og-tag-url',
                                'readonly' => true,
                                'value' => $post->meta['og_tag_url'] ?? '',
                            ]
                        ) ?>
                    </div>
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
                        [
                            'class' => 'form-select',
                            'id' => 'status',
                            'readonly' => true,
                            'disabled' => true,
                            'value' => $post->status
                        ]
                    ) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="intro" class="form-label"><?= __('Intro') ?></label>
                    <?= $this->Form->textarea(
                        'intro',
                        ['class' => 'form-control-plaintext', 'readonly' => true, 'value' => $post->intro]
                    ) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="categories-ids" class="form-label"><?= __('Groups') ?></label>
                    <?= $this->Form->select(
                        'post_groups._ids',
                        $postGroups,
                        ['class' => 'form-select', 'id' => 'categories-ids', 'readonly' => true, 'disabled' => true]
                    ) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="feature-image" class="form-label"><?= __('Feature image') ?></label>
                    <?php if (empty($post->meta['feature_image'])): ?>
                        <p><?= __('- No image -') ?></p>
                    <?php else: ?>
                        <?= $this->Html->image($post->meta['feature_image'], ['class' => 'img-fluid']) ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Html->link(
                    __('Edit'),
                    "/manager/cms/posts/edit/{$post->id}",
                    ['class' => 'btn btn-primary me-md-2']
                ) ?>
                <?= $this->Html->link(__('Back'), "/manager/cmr/posts", ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>