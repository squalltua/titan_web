<nav class="container-fluid bg-white shadow-sm mb-3 border-top">
    <ul class="nav nav-underline">
        <li class="nav-item"><i class="bi bi-arrow-return-right nav-link px-3 disabled"></i></li>
        <li class="nav-item">
            <?= $this->Html->link(__('Medias'), '/manager/dam/medias', ['class' => $subMenuActive === 'medias' ? 'nav-link px-3 active' : 'nav-link px-3']) ?>
        </li>
    </ul>
</nav>