<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VariantsMediasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VariantsMediasTable Test Case
 */
class VariantsMediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VariantsMediasTable
     */
    protected $VariantsMedias;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.VariantsMedias',
        'app.Variants',
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
        $config = $this->getTableLocator()->exists('VariantsMedias') ? [] : ['className' => VariantsMediasTable::class];
        $this->VariantsMedias = $this->getTableLocator()->get('VariantsMedias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VariantsMedias);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VariantsMediasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
