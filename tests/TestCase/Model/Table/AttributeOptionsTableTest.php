<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttributeOptionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttributeOptionsTable Test Case
 */
class AttributeOptionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttributeOptionsTable
     */
    protected $AttributeOptions;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.AttributeOptions',
        'app.Attributes',
        'app.Variants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AttributeOptions') ? [] : ['className' => AttributeOptionsTable::class];
        $this->AttributeOptions = $this->getTableLocator()->get('AttributeOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AttributeOptions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AttributeOptionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AttributeOptionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
