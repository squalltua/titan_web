<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostGroupsTable Test Case
 */
class PostGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostGroupsTable
     */
    protected $PostGroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PostGroups',
        'app.MetaPostGroups',
        'app.Posts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PostGroups') ? [] : ['className' => PostGroupsTable::class];
        $this->PostGroups = $this->getTableLocator()->get('PostGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PostGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
