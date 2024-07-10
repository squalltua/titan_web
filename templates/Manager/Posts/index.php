<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h3>
                    <?= __('Posts') ?>
                    <?= $this->Html->link(__('New'), '/manager/posts/add', ['class' => 'btn btn-primary ms-3']) ?>
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
                    read: "/manager/api/v1/posts.json"
                },
                schema: {
                    model: {
                        fields: {
                            id: {type: "number"},
                            title: {type: "string"},
                            status: {type: "string"},
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
                    field: "title",
                    title: "Title",
                },
                {
                    field: "status",
                    title: "Status",
                    width: 120,
                },
                {
                    field: "created",
                    title: "Created",
                    format: "{0:dd/MM/yyyy}",
                    width: 120,
                },
                {
                    field: "modified",
                    title: "Last modified",
                    format: "{0:dd/MM/yyyy}",
                    width: 120,
                },
                {
                    title: "",
                    text: '<a href="/manager/posts/edit/#:data.id#"><?= __('Edit') ?></a>',
                    exportable: false,
                    filterable: false,
                    width: 120,
                }
            ]
        });
    });
</script>

