<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchaseOrdersFixture
 */
class PurchaseOrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'customer_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'amount_total' => 1.5,
                'amount_tax' => 1.5,
                'amount_discount' => 1.5,
                'amount_net' => 1.5,
                'status' => 'Lorem ipsum dolor sit amet',
                'create_uid' => 1,
                'modified_uid' => 1,
                'created' => '2024-12-07 04:10:13',
                'modified' => '2024-12-07 04:10:13',
            ],
        ];
        parent::init();
    }
}
