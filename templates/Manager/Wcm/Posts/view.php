<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Posts') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/wcm/posts" class="btn btn-secondary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left-dashed">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12h6m3 0h1.5m3 0h.5" />
                        <path d="M5 12l4 4" />
                        <path d="M5 12l4 -4" />
                    </svg>
                    <?= __('Back to list') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <?= $this->element('object_info_post') ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h1 class="display-6"><?= h($post->title) ?></h1>
                        <div class="form-group mb-3">
                            <div class="border p-3 conent-display">
                                <?= $post->content_display ?>
                            </div>
                        </div>
                        <div class="border p-3 mb-3">
                            <div class="form-group mb-3">
                                <label for="meta-posts-og-tag-title"
                                    class="form-label"><?= __('OG Tag Title') ?></label>
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
                                <label for="meta-posts-og-tag-description"
                                    class="form-label"><?= __('OG Tag description') ?></label>
                                <?= $this->Form->textarea(
                                    'meta_posts.og_tag_description',
                                    [
                                        'class' => 'form-control-plaintext',
                                        'id' => 'meta-posts-og-tag-description',
                                        'readonly' => true,
                                        'value' => $post->meta['og_tag_description'] ?? ''
                                    ]
                                ) ?>
                                <div id="emailHelp" class="form-text">
                                    <?= __('Only text for short description for display another plateform.') ?></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta-posts-og-tag-image"
                                    class="form-label"><?= __('OG Tag image') ?></label>
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
                            <label for="group-display" class="form-label"><?= __('Groups') ?></label>
                            <?= $this->Form->text(
                                'groups_display',
                                [
                                    'class' => 'form-select',
                                    'id' => 'group-display',
                                    'readonly' => true,
                                    'disabled' => true,
                                    'multiple' => true,
                                    'value' => $post->groups_display
                                ]
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
            </div>
        </div>
    </div>
</div>