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
                <a href="/manager/wcm/posts/add" class="btn btn-primary d-none d-sm-inline-block">
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
        <?= $this->Form->create($post, ['type' => 'file']) ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Post information') ?></h3>
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
                            <label for="meta-posts-og-tag-title" class="form-label"><?= __('OG Tag Title') ?></label>
                            <?= $this->Form->text('meta_posts.og_tag_title', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-title']) ?>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-description" class="form-label">
                                <?= __('OG Tag description') ?>
                            </label>
                            <?= $this->Form->textarea('meta_posts.og_tag_description', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-description']) ?>
                            <div id="emailHelp" class="form-text">
                                <?= __('Only text for short description for display another plateform.') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="meta-posts-og-tag-image" class="form-label"><?= __('OG Tag image') ?></label>
                            <?php if (empty($post->meta['og_tag_image'])): ?>
                                <?= $this->Form->file('meta_posts.og_tag_image', ['class' => 'form-control', 'id' => 'meta-posts-og-tag-image']) ?>
                            <?php else: ?>
                                <?= $this->Html->image($post->meta['og_tag_image'], ['class' => 'img-fluid']) ?>
                                <div>
                                    <?= $this->Html->link(
                                        __('Remove image'),
                                        "/manager/cms/posts/remove-image/{$post->id}/og_tag_image",
                                        [
                                            'class' => 'text-danger',
                                            'confirm' => __('Do you want to delete this image?')
                                        ]
                                    ) ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
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
                            <?php if (empty($post->meta['feature_image'])): ?>
                                <?= $this->Form->file('meta_posts.feature_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                            <?php else: ?>
                                <?= $this->Html->image($post->meta['feature_image'], ['class' => 'img-fluid']) ?>
                                <div>
                                    <?= $this->Html->link(
                                        __('Remove image'),
                                        "/manager/cms/posts/remove-image/{$post->id}/feature_image",
                                        [
                                            'class' => 'text-danger',
                                            'confirm' => __('Do you want to delete this image?')
                                        ]
                                    ) ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <?= $this->Html->link(__('Cancel'), "/manager/wcm/posts/view/{$post->id}", ['class' => 'btn btn-link']) ?>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
