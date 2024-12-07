<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VariantsAttributeOptionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VariantsAttributeOptionsTable Test Case
 */
class VariantsAttributeOptionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VariantsAttributeOptionsTable
     */
    protected $VariantsAttributeOptions;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.VariantsAttributeOptions',
        'app.Variants',
        'app.AttributeOptions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VariantsAttributeOptions') ? [] : ['className' => VariantsAttributeOptionsTable::class];
        $this->VariantsAttributeOptions = $this->getTableLocator()->get('VariantsAttributeOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VariantsAttributeOptions);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VariantsAttributeOptionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
