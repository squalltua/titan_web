<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h3><?= __('Posts :: New') ?></h3>
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
                            'style' => "width:100%; height:450px"
                        ]
                    ) ?>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary me-md-2', 'name' => 'save_draft']) ?>

                        <div class="form-group mt-3">
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
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="intro" class="form-label"><?= __('Intro') ?></label>
                    <?= $this->Form->textarea('intro', ['class' => 'form-control']) ?>
                </div>

                <div class="form-group mb-3">
                    <label for="categories_ids" class="form-label"><?= __('Tags') ?></label>
                    <select id="categories_ids" name="categories._ids"></select>
                </div>

                <div class="form-group mb-3">
                    <label for="tags_ids" class="form-label"><?= __('Tags') ?></label>
                    <select id="tags_ids" name="tags._ids"></select>
                </div>

                <div class="form-group mb-3">
                    <label for="feature_image" class="form-label"><?= __('Feature image') ?></label>
                    <input type="file" id="file" name="feature_image">
                </div>
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

        function addNew(widgetId, value) {
            var widget = $("#" + widgetId).getKendoMultiSelect();
            var dataSource = widget.dataSource;
            console.log(dataSource.length)


            if (confirm("Are you sure?")) {
                dataSource.add({
                    Id: dataSource.data().length + 1,
                    sportName: value
                });

                var currentValue =  widget.value();
                currentValue.push(dataSource.data().length)
                widget.value(currentValue);
                widget.trigger("change");
            }
        }

        var dataSource = new kendo.data.DataSource({
            data: [
                { Id: 1, sportName: "Basketball"},
                { Id: 2, sportName: "Golf"},
                { Id: 3, sportName: "Baseball"},
                { Id: 4, sportName: "Table Tennis"},
                { Id: 5, sportName: "Volleyball"},
                { Id: 6, sportName: "Football"},
                { Id: 7, sportName: "Boxing"},
                { Id: 8, sportName: "Badminton"},
                { Id: 9, sportName: "Cycling"},
                { Id: 10, sportName: "Gymnastics"},
                { Id: 11, sportName: "Swimming"},
                { Id: 12, sportName: "Wrestling"},
                { Id: 13, sportName: "Snooker"},
                { Id: 14, sportName: "Skiing"},
                { Id: 15, sportName: "Handball"}
            ],
            sort: { field: "sportName", dir: "asc" }
        });

        $("#categories_ids").kendoMultiSelect({
            dataTextField: "sportName",
            dataValueField: "Id",
            dataSource: dataSource,
            filter: "contains",
            placeholder: "Please select your favourite sport...",
            downArrow: true,
            noDataTemplate: $("#noDataTemplate").html()
        });

        $("#tags_ids").kendoMultiSelect({
            dataTextField: "sportName",
            dataValueField: "Id",
            dataSource: dataSource,
            filter: "contains",
            placeholder: "Please select your favourite sport...",
            downArrow: true,
            noDataTemplate: $("#noDataTemplate").html()
        });

        var editor = $("#content").kendoEditor({
            stylesheets: [
                "../content/shared/styles/editor.css",
            ],
            tools: [
                "undo",
                "redo",
                {name: "separator1", type:"separator"},
                "fontSize",
                "bold",
                "italic",
                "underline",
                "backColor",
                "foreColor",
                {name: "separator2", type:"separator"},
                "insertUnorderedList",
                "justifyLeft",
                "justifyCenter",
                "justifyRight",
                {name: "separator3", type:"separator"},
                "formatting",
                {name: "separator4", type:"separator"},
                "createLink",
                "unlink",
                "insertImage",
                {name: "separator5", type:"separator"},
                "tableWizard",
                "tableProperties",
                "tableCellProperties",
                "createTable",
                "addRowAbove",
                "addRowBelow",
                "addColumnLeft",
                "addColumnRight",
                "deleteRow",
                "deleteColumn",
                "mergeCellsHorizontally",
                "mergeCellsVertically",
                "splitCellHorizontally",
                "splitCellVertically",
                "tableAlignLeft",
                "tableAlignCenter",
                "tableAlignRight"
            ]
        });

        var initUpload = function () {
            var validation = {
                allowedExtensions: ['jpg','png'],
                maxFileSize: 4194304
            };

            $("#file").kendoUpload({
                async: {
                    chunkSize: 11000,// bytes
                    saveUrl: "chunksave",
                    removeUrl: "remove",
                    autoUpload: false
                },
                validation: validation,
                // dropZone: ".dropZoneElement"
            }).data("kendoUpload");
        };

        initUpload();
    });
</script>