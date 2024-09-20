<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxonomiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxonomiesTable Test Case
 */
class TaxonomiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxonomiesTable
     */
    protected $Taxonomies;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Taxonomies',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Taxonomies') ? [] : ['className' => TaxonomiesTable::class];
        $this->Taxonomies = $this->getTableLocator()->get('Taxonomies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Taxonomies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
