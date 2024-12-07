<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostsGroupsTable Test Case
 */
class PostsGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostsGroupsTable
     */
    protected $PostsGroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PostsGroups',
        'app.Posts',
        'app.Groups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PostsGroups') ? [] : ['className' => PostsGroupsTable::class];
        $this->PostsGroups = $this->getTableLocator()->get('PostsGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PostsGroups);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PostsGroupsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
