<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'summary' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'base_price' => 1.5,
                'sell_price' => 1.5,
                'discount_price' => 1.5,
                'sku' => 'Lorem ipsum dolor sit amet',
                'model_name' => 'Lorem ipsum dolor sit amet',
                'series_number' => 'Lorem ipsum dolor sit amet',
                'on_sale' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'start_at' => '2024-09-22 08:34:59',
                'end_at' => '2024-09-22 08:34:59',
                'created' => '2024-09-22 08:34:59',
                'modified' => '2024-09-22 08:34:59',
                'adminuser_id' => 1,
                'product_family_id' => 1,
            ],
        ];
        parent::init();
    }
}
