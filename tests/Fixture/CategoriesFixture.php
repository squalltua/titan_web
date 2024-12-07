<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoriesFixture
 */
class CategoriesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'parent_id' => 1,
                'lft' => 1,
                'rght' => 1,
                'level' => 1,
                'created' => '2024-12-07 04:10:09',
                'modified' => '2024-12-07 04:10:09',
            ],
        ];
        parent::init();
    }
}
