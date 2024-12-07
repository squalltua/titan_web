<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VariantsAttributeOptionsFixture
 */
class VariantsAttributeOptionsFixture extends TestFixture
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
                'variant_id' => 1,
                'attribute_option_id' => 1,
            ],
        ];
        parent::init();
    }
}
