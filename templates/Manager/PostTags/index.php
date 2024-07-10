<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h3>
                    <?= __('Post Tags') ?>
                    <?= $this->Html->link(__('New'), '/manager/posts/tags/add', ['class' => 'btn btn-primary ms-3']) ?>
                </h3>
            </div>
        </div>

        <div id="grid"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#grid").kendoGrid({
            dataSource: {
                transport: {
                    read: "/manager/api/v1/post-tags.json"
                },
                schema: {
                    model: {
                        fields: {
                            id: {type: "number"},
                            name: {type: "string"},
                            created: {type: "date"},
                            modified: {type: "date"},
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },
            toolbar: ['search'],
            height: 700,
            size: "small",
            filterable: true,
            sortable: true,
            pageable: true,
            columns: [
                {
                    field: "name",
                    title: "Category name",
                },
                {
                    field: "created",
                    title: "Created",
                    format: "{0:dd/MM/yyyy}",
                    width: 120,
                },
                {
                    title: "",
                    text: '<a href="/manager/posts/tags/edit/#:data.id#"><?= __('Edit') ?></a>',
                    exportable: false,
                    filterable: false,
                    width: 120,
                }
            ]
        });
    });
</script>

