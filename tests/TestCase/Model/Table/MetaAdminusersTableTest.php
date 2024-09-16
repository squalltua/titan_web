<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaAdminusersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaAdminusersTable Test Case
 */
class MetaAdminusersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaAdminusersTable
     */
    protected $MetaAdminusers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaAdminusers',
        'app.Adminusers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MetaAdminusers') ? [] : ['className' => MetaAdminusersTable::class];
        $this->MetaAdminusers = $this->getTableLocator()->get('MetaAdminusers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaAdminusers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaAdminusersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaAdminusersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
