<div class="row">
    <div class="col">
        <h4>
            <?= __('Medias') ?>
            <?= $this->Html->link(__('New'), '/manager/dam/medias/add', ['class' => 'btn btn-primary btn-sm ms-3']) ?>
        </h4>
    </div>
</div>

<div class="row">
    <?php foreach ($medias as $media): ?>
        <div class="col-2">
            <div class="card mb-3">
                <?= $this->Html->image($media->link_url, ['class' => 'card-img-top']) ?>
                <div class="card-body">
                    <p><?= $media->filename ?></p>
                    <div class="input-group mb-3 copy-link">
                        <input type="text" class="copy-link-input form-control form-control-sm" value="<?= $media->link_url ?>" onclick="this.select()">
                        <button class="btn btn-sm btn-outline-secondary copy-link-button" type="button" id="button-addon2">Copy</button>
                    </div>
                    <?= $this->Html->link(__('Edit'), "/manager/dam/medias/edit/{$media->id}", ['class' => 'card-link me-3']) ?>
                    <?= $this->Form->postLink(__('Delete'), "/manager/dam/medias/delete/{$media->id}", ['class' => 'card-link text-danger', 'confirm' => __('Do you want delete this image?')]) ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?= $this->Paginator->prev('« Previous') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('Next »') ?>
                </ul>
            </nav>
            <div>
                <?= $this->Paginator->counter('range'); ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".copy-link").forEach((copyLinkParent) => {
        const inputField = copyLinkParent.querySelector(".copy-link-input");
        const copyButton = copyLinkParent.querySelector(".copy-link-button");
        const text = inputField.value;

        inputField.addEventListener("focus", () => inputField.select());

        copyButton.addEventListener("click", () => {
            inputField.select();
            navigator.clipboard.writeText(text);

            inputField.value = "Copied!";
            setTimeout(() => (inputField.value = text), 2000);
        });
    });
</script>