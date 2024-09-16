<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientAddressesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientAddressesTable Test Case
 */
class ClientAddressesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientAddressesTable
     */
    protected $ClientAddresses;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ClientAddresses',
        'app.Clientusers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ClientAddresses') ? [] : ['className' => ClientAddressesTable::class];
        $this->ClientAddresses = $this->getTableLocator()->get('ClientAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ClientAddresses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientAddressesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientAddressesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
