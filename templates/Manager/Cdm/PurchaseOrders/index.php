<div class="card shadow-sm">
    <?= $this->element('object_info_customer') ?>
    <div class="card-body">
        <?= $this->Html->link(__('New orders'), "/manager/cdm/customers/orders/{$customer->id}/add", ['class' => 'btn btn-primary mb-3']) ?>
        <?php if (!empty($orders)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('title') ?></th>
                        <th><?= $this->Paginator->sort('amount_total') ?></th>
                        <th><?= $this->Paginator->sort('amount_tax') ?></th>
                        <th><?= $this->Paginator->sort('amount_discount') ?></th>
                        <th><?= $this->Paginator->sort('amount_net') ?></th>
                        <th><?= $this->Paginator->sort('status') ?></th>
                        <th><?= __('Action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order->title ?></td>
                        <td><?= $this->Number->precision($order->amount_total, 2) ?></td>
                        <td><?= $this->Number->precision($order->amount_tax, 2) ?></td>
                        <td><?= $this->Number->precision($order->amount_discount, 2) ?></td>
                        <td><?= $this->Number->precision($order->amount_net, 2) ?></td>
                        <td><?= $order->status ?></td>
                        <td>
                            <?= $this->Html->link(
                                __('Edit'), 
                                "/manager/cdm/customers/orders/{$customer->id}/edit/{$order->id}", 
                                ['class' => 'me-3']
                            ) ?>
                            <?= $this->Form->postLink(
                                __('Delete'), 
                                "/manager/cdm/customers/orders/{$customer->id}/delete/{$order->id}", 
                                ['class' => 'text-danger', 'confirm' => __('Do you want delete this data?')]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>

        <?php endif ?>
    </div>
</div>