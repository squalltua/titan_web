<div class="card shadow-sm">
    <?= $this->element('object_info_product') ?>
    <div class="card-body">
        <?= $this->Form->create(null, ['type' => 'file']) ?>
        <div class="row">
            <div class="col-4">
                <h4><?= __('Feature image') ?></h4>
                <p class="text-help"><?= __('The feature image has only 1 image.') ?></p>
                <?php if($medias['featureMediaImage']): ?>
                <?= $this->Html->image($medias['featureMediaImage']['link_url'], ['class' => 'img-fluid']) ?>
                <div class="mt-3">
                    <?= $this->Html->link(__('Remove'), "/manager/pim/products/images/remove-image/{$product->id}/{$medias['featureMediaImage']['id']}", ['class' => 'text-danger']) ?>
                </div>
                <?php else: ?>
                <div class="form-group mb-3">
                    <label for="feature-image" class="form-label"><?= __('Feature Image uploader') ?></label>
                    <?= $this->Form->file('feature_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                </div>
                <?php endif ?>
            </div>
            <div class="col-8">
                <h4><?= __('Product images') ?></h4>
                <p class="text-help"><?= __('Product images can be more than one. We recommend 5 images.') ?></p>
                <div class="form-group mb-3">
                    <label for="product-image" class="form-label"><?= __('Product image uploader') ?></label>
                    <?= $this->Form->file('product_image', ['class' => 'form-control', 'id' => 'feature-image']) ?>
                </div>

                <div class="row row-cols-5 g-4">
                    <?php foreach ($medias['productMediaImages'] as $prdImage): ?>
                    <div class="col">
                        <div class="card">
                            <?= $this->Html->image($prdImage['link_url'], ['class' => 'card-img-top']) ?>
                            <div class="card-body">
                                <?= $this->Html->link(__('Remove'), "/pim/products/images/remove-image/{$product->id}/{$prdImage->id}", ['class' => 'text-danger']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <?= $this->Form->button(__('Upload'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>