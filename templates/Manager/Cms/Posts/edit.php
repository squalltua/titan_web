<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4><?= __('Posts :: Edit') ?></h4>
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
                    <label for="slug" class="form-label"><?= __('Slug') ?></label>
                    <?= $this->Form->text('slug', ['class' => 'form-control', 'id' => 'slug']) ?>
                </div>
                <div class="form-group mb-3">
                    <label for="content"><?= __('Content') ?></label>
                    <?= $this->Form->textarea(
                        'content',
                        [
                            'class' => 'form-control',
                            'id' => 'content',
                            'rows' => '10',
                            'style' => "width:100%; height:500px"
                        ]
                    ) ?>
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
                    <label for="categories-ids" class="form-label"><?= __('Categories') ?></label>
                    <?= $this->Form->select('categories._ids', $categories, ['class' => 'form-select', 'id' => 'categories-ids']) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="tags-ids" class="form-label"><?= __('Tags') ?></label>
                    <?= $this->Form->select('tags._ids', $categories, ['class' => 'form-select', 'id' => 'tags-ids']) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="feature-image" class="form-label"><?= __('Feature image') ?></label>
                    <?= $this->Form->file('menta_posts.feature_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary me-md-2']) ?>
                <?= $this->Form->postLink(
                    __('Delete'),
                    "/manager/posts/delete/{$post->id}",
                    [
                        'class' => 'btn btn-danger me-md-2',
                    ]
                ) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#title").keyup(function() {
            const slug = $(this).val().slugify();
            $("#slug").val(slug);
        })

        var editor = $("#content").kendoEditor({
            stylesheets: [
                "../content/shared/styles/editor.css",
            ],
            tools: [
                "undo",
                "redo",
                {
                    name: "separator1",
                    type: "separator"
                },
                "fontSize",
                "bold",
                "italic",
                "underline",
                "backColor",
                "foreColor",
                {
                    name: "separator2",
                    type: "separator"
                },
                "insertUnorderedList",
                "justifyLeft",
                "justifyCenter",
                "justifyRight",
                {
                    name: "separator3",
                    type: "separator"
                },
                "formatting",
                {
                    name: "separator4",
                    type: "separator"
                },
                "createLink",
                "unlink",
                "insertImage",
                {
                    name: "separator5",
                    type: "separator"
                },
                "tableWizard",
                "tableProperties",
                "tableCellProperties",
                "createTable",
            ]
        });
    });
</script>