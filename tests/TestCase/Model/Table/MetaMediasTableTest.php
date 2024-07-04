<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaMediasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaMediasTable Test Case
 */
class MetaMediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaMediasTable
     */
    protected $MetaMedias;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaMedias',
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
        $config = $this->getTableLocator()->exists('MetaMedias') ? [] : ['className' => MetaMediasTable::class];
        $this->MetaMedias = $this->getTableLocator()->get('MetaMedias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaMedias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaMediasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaMediasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
