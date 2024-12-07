<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientusersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientusersTable Test Case
 */
class ClientusersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientusersTable
     */
    protected $Clientusers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Clientusers',
        'app.ClientAddresses',
        'app.ClientPayments',
        'app.PostComments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Clientusers') ? [] : ['className' => ClientusersTable::class];
        $this->Clientusers = $this->getTableLocator()->get('Clientusers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clientusers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientusersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientusersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
