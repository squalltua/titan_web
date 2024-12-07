<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VariantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VariantsTable Test Case
 */
class VariantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VariantsTable
     */
    protected $Variants;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Variants',
        'app.Products',
        'app.AttributeOptions',
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
        $config = $this->getTableLocator()->exists('Variants') ? [] : ['className' => VariantsTable::class];
        $this->Variants = $this->getTableLocator()->get('Variants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Variants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VariantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VariantsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
