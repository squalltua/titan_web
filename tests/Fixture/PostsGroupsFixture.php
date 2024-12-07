<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsGroupsFixture
 */
class PostsGroupsFixture extends TestFixture
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
                'post_id' => 1,
                'group_id' => 1,
            ],
        ];
        parent::init();
    }
}
