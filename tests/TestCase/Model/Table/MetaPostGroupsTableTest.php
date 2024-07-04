<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaPostGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaPostGroupsTable Test Case
 */
class MetaPostGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaPostGroupsTable
     */
    protected $MetaPostGroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaPostGroups',
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
        $config = $this->getTableLocator()->exists('MetaPostGroups') ? [] : ['className' => MetaPostGroupsTable::class];
        $this->MetaPostGroups = $this->getTableLocator()->get('MetaPostGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaPostGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaPostGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaPostGroupsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
