<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MetaPostsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MetaPostsTable Test Case
 */
class MetaPostsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MetaPostsTable
     */
    protected $MetaPosts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MetaPosts',
        'app.Posts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MetaPosts') ? [] : ['className' => MetaPostsTable::class];
        $this->MetaPosts = $this->getTableLocator()->get('MetaPosts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MetaPosts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MetaPostsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MetaPostsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
