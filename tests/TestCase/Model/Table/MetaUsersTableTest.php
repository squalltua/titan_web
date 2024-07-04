<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaUsersTable Test Case
 */
class MetaUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaUsersTable
     */
    protected $MetaUsers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaUsers',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MetaUsers') ? [] : ['className' => MetaUsersTable::class];
        $this->MetaUsers = $this->getTableLocator()->get('MetaUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
