<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductFamiliesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductFamiliesTable Test Case
 */
class ProductFamiliesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductFamiliesTable
     */
    protected $ProductFamilies;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ProductFamilies',
        'app.MetaProductFamilies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductFamilies') ? [] : ['className' => ProductFamiliesTable::class];
        $this->ProductFamilies = $this->getTableLocator()->get('ProductFamilies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductFamilies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductFamiliesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
