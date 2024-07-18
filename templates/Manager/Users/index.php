<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4>
                    <?= __('Users') ?>
                    <?= $this->Html->link(__('New'), '/manager/users/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
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
                    read: "/manager/api/v1/users.json"
                },
                schema: {
                    model: {
                        fields: {
                            id: {type: "number"},
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
                    field: "full_name",
                    title: "Full name",
                },
                {
                    field: "username",
                    title: "Username",
                },
                {
                    field: "email",
                    title: "Email",
                },
                {
                    field: "role",
                    title: "Role",
                    width: 120,
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
                    template: '<a href="/manager/users/edit/#:data.id#" class="btn btn-sm btn-link"><?= __('Edit') ?></a>',
                    exportable: false,
                    filterable: false,
                    attributes: {class: 'text-center'},
                    width: 120,
                }
            ]
        });
    });
</script>

