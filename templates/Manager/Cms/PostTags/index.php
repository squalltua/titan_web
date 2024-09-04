<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1">
                <h4>
                    <?= __('Post Tags') ?>
                    <?= $this->Html->link(__('New'), '/manager/posts/tags/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
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
                    read: "/manager/api/v1/post-tags.json"
                },
                schema: {
                    model: {
                        fields: {
                            id: {type: "number"},
                            name: {type: "string"},
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
                    title: "Tag name",
                },
                {
                    title: "",
                    template: '<a href="/manager/posts/tags/edit/#:data.id#" class="btn btn-sm btn-link"><?= __('Edit') ?></a>',
                    exportable: false,
                    filterable: false,
                    attributes: {class: 'text-center'},
                    width: 120,
                }
            ]
        });
    });
</script>

