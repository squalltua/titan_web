<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttributeOptionsFixture
 */
class AttributeOptionsFixture extends TestFixture
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
                'attribute_id' => 1,
                'value' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-12-07 04:10:08',
                'modified' => '2024-12-07 04:10:08',
            ],
        ];
        parent::init();
    }
}
