<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VariantsHasMediasFixture
 */
class VariantsHasMediasFixture extends TestFixture
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
                'media_id' => 1,
            ],
        ];
        parent::init();
    }
}
