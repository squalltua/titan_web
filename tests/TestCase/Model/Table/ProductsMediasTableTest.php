<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsMediasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsMediasTable Test Case
 */
class ProductsMediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsMediasTable
     */
    protected $ProductsMedias;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ProductsMedias',
        'app.Products',
        'app.Medias',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductsMedias') ? [] : ['className' => ProductsMediasTable::class];
        $this->ProductsMedias = $this->getTableLocator()->get('ProductsMedias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductsMedias);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductsMediasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
