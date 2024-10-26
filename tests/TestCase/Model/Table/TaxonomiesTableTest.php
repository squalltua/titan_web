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

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getTypes method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getTypes()
     */
    public function testGetTypes(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getType method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getType()
     */
    public function testGetType(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getTypesList method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getTypesList()
     */
    public function testGetTypesList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategories method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getCategories()
     */
    public function testGetCategories(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategory method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getCategory()
     */
    public function testGetCategory(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategoriesList method
     *
     * @return void
     * @uses \App\Model\Table\TaxonomiesTable::getCategoriesList()
     */
    public function testGetCategoriesList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
