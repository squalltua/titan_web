<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaCustomersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaCustomersTable Test Case
 */
class MetaCustomersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaCustomersTable
     */
    protected $MetaCustomers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaCustomers',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MetaCustomers') ? [] : ['className' => MetaCustomersTable::class];
        $this->MetaCustomers = $this->getTableLocator()->get('MetaCustomers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaCustomers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaCustomersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaCustomersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
