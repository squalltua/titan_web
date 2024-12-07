<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VariantsHasMediasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VariantsHasMediasTable Test Case
 */
class VariantsHasMediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VariantsHasMediasTable
     */
    protected $VariantsHasMedias;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.VariantsHasMedias',
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
        $config = $this->getTableLocator()->exists('VariantsHasMedias') ? [] : ['className' => VariantsHasMediasTable::class];
        $this->VariantsHasMedias = $this->getTableLocator()->get('VariantsHasMedias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VariantsHasMedias);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VariantsHasMediasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
