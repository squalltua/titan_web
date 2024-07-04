<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsPostGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostsPostGroupsTable Test Case
 */
class PostsPostGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostsPostGroupsTable
     */
    protected $PostsPostGroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PostsPostGroups',
        'app.Posts',
        'app.PostGroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PostsPostGroups') ? [] : ['className' => PostsPostGroupsTable::class];
        $this->PostsPostGroups = $this->getTableLocator()->get('PostsPostGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PostsPostGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PostsPostGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PostsPostGroupsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
