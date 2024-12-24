<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Add Variant option information') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Products') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/pim/products/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    <?= __('Create new') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <?= $this->element('object_info_product') ?>
            <div class="card-body">
                <?= $this->Form->create() ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= __('Variant :: selection option') ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3 row">
                                    <label for="attribute-id"
                                        class="col-3 col-form-label required"><?= __('Variant') ?></label>
                                    <div class="col">
                                        <?= $this->Form->select(
                                            'attribute_id', 
                                            $variantOptions, 
                                            [
                                                'class' => 'form-select', 
                                                'empty' => __('Please select'), 
                                                'id' => 'attribute-id',
                                                'onchange' => 'loadOptions()',
                                            ]
                                        ) ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="attribute-option-id"
                                        class="col-3 col-form-label required"><?= __('Option') ?></label>
                                    <div class="col">
                                        <?= $this->Form->select('attribute_option_id', [], ['class' => 'form-select', 'empty' => __('Please select'), 'id' => 'attribute-option-id']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <?= $this->Html->link(__('Cancel'), "/manager/pim/products/vaiants/{$product->id}", ['class' => 'btn btn-link']) ?>
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary ms-auto']) ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
async function loadOptions() {
    let attributeOptions = document.getElementById('attribute-option-id');
    const attributeId = document.getElementById('attribute-id').value;
    if (!attributeId) {
        resetSelect(attributeOptions);
        return;
    }

    const url = '/manager/api/v1/variant-attributes/get-option-list.json?id=' + attributeId;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        resetSelect(attributeOptions);
        const options = response.json();
        options.then((obj) => {
           obj.forEach(element => {
                console.log(element.value);
                let optionTag = document.createElement('option');
                optionTag.innerHTML = element.value;
                optionTag.value = element.id;
                attributeOptions.appendChild(optionTag);
           });
        });
    } catch (error) {
        console.error(error.message);
    }
}

function resetSelect(selectInput) {
    selectInput.innerHTML = '';
    const emptyOption = document.createElement('option');
    emptyOption.innerHTML = 'Please select';
    selectInput.appendChild(emptyOption);
}
</script>