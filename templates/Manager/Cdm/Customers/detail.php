<div class="card shadow-sm">
    <?= $this->element('object_info_customer') ?>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <dl class="row">
                    <dt class="col-3"><?= __('Phone') ?></dt>
                    <dd class="col-9"><?= $customer->phone ?></dd>

                    <dt class="col-3"><?= __('Email') ?></dt>
                    <dd class="col-9"><?= $customer->email ?></dd>
                </dl>
            </div>
            <div class="col-6"></div>
        </div>
    </div>
</div>