<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaProductFamiliesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaProductFamiliesTable Test Case
 */
class MetaProductFamiliesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaProductFamiliesTable
     */
    protected $MetaProductFamilies;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaProductFamilies',
        'app.ProductFamilies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MetaProductFamilies') ? [] : ['className' => MetaProductFamiliesTable::class];
        $this->MetaProductFamilies = $this->getTableLocator()->get('MetaProductFamilies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaProductFamilies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaProductFamiliesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaProductFamiliesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
