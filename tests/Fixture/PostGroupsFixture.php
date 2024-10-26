<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostGroupsFixture
 */
class PostGroupsFixture extends TestFixture
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
                'type' => 'Lorem ipsum dolor ',
                'parent_id' => 1,
                'lft' => 1,
                'rght' => 1,
            ],
        ];
        parent::init();
    }
}
