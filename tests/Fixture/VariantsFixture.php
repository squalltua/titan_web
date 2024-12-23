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
                'title' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'sku' => 'Lorem ipsum dolor sit amet',
                'supplier_price' => 1.5,
                'sell_price' => 1.5,
                'discount_price' => 1.5,
                'stock_quantity' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-12-23 10:12:52',
                'modified' => '2024-12-23 10:12:52',
            ],
        ];
        parent::init();
    }
}
