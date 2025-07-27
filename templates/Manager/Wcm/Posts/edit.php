<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Edit information') ?>
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
        <?= $this->Form->create($post, ['type' => 'file']) ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Post information') ?></h3>
                <div class="ms-auto me-3"><?= __('Edit in language') ?></div>
                <div class="dropdown">
                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown"><?= $languages[$selectLanguage] ?></a>
                    <div class="dropdown-menu">
                        <?php foreach ($languages as $unicode => $language): ?>
                            <?= $this->Html->link($language, "?lang={$unicode}", ['class' => 'dropdown-item']) ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="title" class="form-label required"><?= __('Title') ?></label>
                            <?= $this->Form->text('title', ['class' => 'form-control', 'id' => 'title', 'required' => true]) ?>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">
                                <?= __('Content (Markdown syntex supported)') ?>
                            </label>
                            <?= $this->Form->textarea(
                                'content',
                                [
                                    'class' => 'form-control',
                                    'id' => 'content',
                                    'rows' => '10',
                                    'style' => "width:100%; height:500px",
                                ]
                            ) ?>
                            <div id="emailHelp" class="form-text">
                                <?= __('The content box is supported Markdown syntext. We recommened use Markdown.') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-title"
                                class="form-label"><?= __('OG Tag Title') ?></label>
                            <?= $this->Form->text(
                                'meta_posts.og_tag_title',
                                [
                                    'class' => 'form-control',
                                    'id' => 'meta-posts-og-tag-title',
                                    'value' => $post->meta['og_tag_title'] ?: null
                                ]
                            ) ?>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-description" class="form-label">
                                <?= __('OG Tag description') ?>
                            </label>
                            <?= $this->Form->textarea(
                                'meta_posts.og_tag_description',
                                [
                                    'class' => 'form-control',
                                    'id' => 'meta-posts-og-tag-description',
                                    'value' => $post->meta['og_tag_description']
                                ]
                            ) ?>
                            <div id="emailHelp" class="form-text">
                                <?= __('Only text for short description for display another plateform.') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-image" class="form-label">
                                <?= __('OG Tag image') ?>
                            </label>
                            <?= $this->Form->file('meta_posts.og_tag_image', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-image']) ?>
                            <?php if (!empty($post->meta['og_tag_image'])): ?>
                                <div class="mt-3">
                                    <?= $this->Html->image($post->meta['og_tag_image'], ['class' => 'img-fluid']) ?>
                                    <div class="mb-3">
                                        <?= $this->Html->link(
                                            __('Remove image'),
                                            "/manager/wcm/posts/remove-image/{$post->id}/og_tag_image/{$selectLanguage}",
                                            [
                                                'class' => 'btn btn-sm btn-danger mt-2',
                                                'confirm' => __('Do you want to delete this image?')
                                            ]
                                        ) ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-url"
                                class="form-label"><?= __('OG Tag URL') ?></label>
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
                            <label for="groups-ids" class="form-label"><?= __('Groups') ?></label>
                            <?= $this->Form->select(
                                'groups._ids',
                                $groups,
                                [
                                    'class' => 'form-select',
                                    'id' => 'groups-ids',
                                    'multiple' => true
                                ]
                            ) ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="feature-image" class="form-label"><?= __('Feature image') ?></label>
                            <?= $this->Form->file('meta_posts.feature_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                            <?php if (!empty($post->meta['feature_image'])): ?>
                                <div class="mt-3">
                                    <?= $this->Html->image($post->meta['feature_image'], ['class' => 'img-fluid']) ?>
                                    <div class="mt-2">
                                        <?= $this->Html->link(
                                            __('Remove image'),
                                            "/manager/wcm/posts/remove-image/{$post->id}/feature_image/{$selectLanguage}",
                                            [
                                                'class' => 'btn btn-sm btn-danger',
                                                'confirm' => __('Do you want to delete this image?')
                                            ]
                                        ) ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <?= $this->Html->link(__('Back to view'), "/manager/wcm/posts/view/{$post->id}", ['class' => 'btn btn-link']) ?>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>