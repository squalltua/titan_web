<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomersTable Test Case
 */
class CustomersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomersTable
     */
    protected $Customers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Customers',
        'app.Contacts',
        'app.CustomerNotes',
        'app.MetaCustomers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Customers') ? [] : ['className' => CustomersTable::class];
        $this->Customers = $this->getTableLocator()->get('Customers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Customers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CustomersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getListCompanyTypes method
     *
     * @return void
     * @uses \App\Model\Table\CustomersTable::getListCompanyTypes()
     */
    public function testGetListCompanyTypes(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getListServiceTypes method
     *
     * @return void
     * @uses \App\Model\Table\CustomersTable::getListServiceTypes()
     */
    public function testGetListServiceTypes(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
