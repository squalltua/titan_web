<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientPaymentsFixture
 */
class ClientPaymentsFixture extends TestFixture
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
                'clientuser_id' => 1,
                'payment_type' => 'Lorem ipsum dolor sit amet',
                'provider' => 'Lorem ipsum dolor sit amet',
                'account_number' => 'Lorem ipsum dolor sit amet',
                'expire_date' => '2024-12-07',
                'created' => '2024-12-07 04:10:09',
                'modified' => '2024-12-07 04:10:09',
            ],
        ];
        parent::init();
    }
}
