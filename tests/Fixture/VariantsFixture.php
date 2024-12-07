<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VariantsFixture
 */
class VariantsFixture extends TestFixture
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
                'product_id' => 1,
                'sku' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'created' => '2024-12-07 04:10:14',
                'modified' => '2024-12-07 04:10:14',
            ],
        ];
        parent::init();
    }
}
