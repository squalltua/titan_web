<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="/manager"><?= __('TF Manager') ?></a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <?= __('Core') ?>
            </li>
            <li class="sidebar-item">
                <?= $this->Html->link(
                    '<i class="bi bi-file-earmark-medical pe-2"></i>' . __('บันทึกที่ละรายการ'),
                    '/report-records/add',
                    [
                        'class' => $menuActive === 'add_one' ? 'sidebar-link active' : 'sidebar-link',
                        'escape' => false,
                    ]
                ) ?>
            </li>


            <li class="sidebar-header">
                <?= __('Reporting') ?>
            </li>
            <li class="sidebar-item">
                <?= $this->Html->link(
                    '<i class="bi bi-printer pe-2"></i>' . __('สร้าง Excel ไฟล์'),
                    '/printing-records',
                    [
                        'class' => $menuActive === 'export' ? 'sidebar-link active' : 'sidebar-link',
                        'escape' => false,
                    ]
                ) ?>
            </li>
            <?php if ($this->Identity->get('role') !== 'enduser') : ?>
                <li class="sidebar-header">
                    <?= __('Settings') ?>
                </li>
                <li class="sidebar-item">
                    <?= $this->Html->link(
                        '<i class="bi bi-calendar3 pe-2"></i>' . __('ปีงบประมาณ'),
                        '/fiscal-years',
                        [
                            'class' => $menuActive === 'fiscal_year' ? 'sidebar-link active' : 'sidebar-link',
                            'escape' => false,
                        ]
                    ) ?>
                </li>
                <li class="sidebar-item">
                    <?= $this->Html->link(
                        '<i class="bi bi-diagram-3 pe-2"></i>' . __('หน่วย'),
                        '/units',
                        [
                            'class' => $menuActive === 'unit' ? 'sidebar-link active' : 'sidebar-link',
                            'escape' => false,
                        ]
                    ) ?>
                </li>
                <li class="sidebar-item">
                    <?= $this->Html->link(
                        '<i class="bi bi-people-fill pe-2"></i>' . __('บัญชีผู้ใช้งาน'),
                        '/users',
                        [
                            'class' => $menuActive === 'user' ? 'sidebar-link active' : 'sidebar-link',
                            'escape' => false,
                        ]
                    ) ?>
                </li>
            <?php endif ?>
        </ul>
    </div>
</aside>
