<div class="card shadow-sm">
    <?= $this->element('object_info_product') ?>
    <div class="card-body">
        <?= $this->Html->link(__('New attribute'), "/manager/pim/products/attribute-add/{$product->id}", ['class' => 'btn btn-primary mb-3']) ?>
        <?php if (!empty($product->attributes)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Content') ?></th>
                    <th><?= __('Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product->attributes as $attribute): ?>
                    <tr>
                        <td><?= h($attribute->name) ?></td>
                        <td><?= nl2br($attribute->content) ?></td>
                        <td>
                            <?= $this->Html->link(__('Edit'), "/manager/pim/products/attribute-edit/{$product->id}/{$attribute->id}", ['class' => 'me-3']) ?>
                            <?= $this->Form->postLink(__('Delete'), "/manager/pim/products/attribute-delete/{$product->id}/{$attribute->id}", ['class' => 'text-danger', 'confirm' => __('Do you want delete this data?')]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="p-2 mb-4">
            <div class="container-fluid py-5 text-muted text-center">
                <h1 class="display-5 text-center"><?= __('No data') ?></h1>
                <p class="fs-4 text-center"><?= __('Please insert first') ?></p>
                <?= $this->Html->link(__('New'), "/manager/pim/products/attribute-add/{$product->id}", ['class' => 'btn btn-secondary btn-lg ms-3']) ?>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>