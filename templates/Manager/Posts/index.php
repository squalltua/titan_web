<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4>
                    <?= __('Posts') ?>
                    <?= $this->Html->link(__('New'), '/manager/posts/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
                </h4>
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
                    attributes: {class: "text-center"},
                },
                {
                    field: "created",
                    title: "Created",
                    format: "{0:dd/MM/yyyy}",
                    width: 120,
                    attributes: {class: "text-center"},
                },
                {
                    field: "modified",
                    title: "Last modified",
                    format: "{0:dd/MM/yyyy}",
                    width: 120,
                    attributes: {class: "text-center"},
                },
                {
                    title: "",
                    template: '<a href="/manager/posts/edit/#:data.id#"><?= __('Edit') ?></a>',
                    exportable: false,
                    filterable: false,
                    width: 120,
                    attributes: {class: "text-center"},
                }
            ]
        });
    });
</script>

