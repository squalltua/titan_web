<div class="card-header">
    <div>
        <div class="row align-items-center">
            <div class="col">
                <div class="card-title"><?= $post->title ?></div>
                <div class="card-subtitle"><?= $post->slug ?></div>
            </div>
        </div>
    </div>
    <div class="ms-auto me-3"><?= __('View in language') ?></div>
    <div class="dropdown">
        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown"><?= $languages[$selectLanguage] ?></a>
        <div class="dropdown-menu">
            <?php foreach ($languages as $unicode => $language): ?>
                <?= $this->Html->link($language, "?lang={$unicode}", ['class' => 'dropdown-item']) ?>
            <?php endforeach ?>
        </div>
    </div>
    <div class="ms-3">
        <a href="<?= __('/manager/wcm/posts/edit/{0}', $post->id) ?>" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                <path d="M16 5l3 3" />
            </svg>
            <?= __('Edit') ?>
        </a>
    </div>
</div>