<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <?= __('Index table') ?>
                </div>
                <h2 class="page-title">
                    <?= __('Medias') ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/manager/dam/medias/add" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
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
            <div class="card-body">
                <div class="row">
                    <?php foreach ($medias as $media): ?>
                        <div class="col-2">
                            <div class="card mb-3">
                                <?= $this->Html->image($media->link_url, ['class' => 'card-img-top']) ?>
                                <div class="card-body">
                                    <p><?= $media->filename ?></p>
                                    <div class="input-group mb-3 copy-link">
                                        <input type="text" class="copy-link-input form-control form-control-sm"
                                               value="<?= $media->link_url ?>" onclick="this.select()">
                                        <button class="btn btn-sm btn-outline-secondary copy-link-button" type="button"
                                                id="button-addon2">Copy
                                        </button>
                                    </div>
                                    <?= $this->Html->link(__('Edit'), "/manager/dam/medias/edit/{$media->id}", ['class' => 'card-link me-3']) ?>
                                    <?= $this->Form->postLink(__('Delete'), "/manager/dam/medias/delete/{$media->id}", ['class' => 'card-link text-danger', 'confirm' => __('Do you want delete this image?')]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center">
                <ul class="pagination m-0">
                    <?= $this->Paginator->prev('« Previous') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('Next »') ?>
                </ul>
                <p class="m-0 ms-auto text-secondary"><?= $this->Paginator->counter('range'); ?></p>
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
