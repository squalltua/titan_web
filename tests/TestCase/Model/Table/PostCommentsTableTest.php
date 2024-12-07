<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostCommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostCommentsTable Test Case
 */
class PostCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostCommentsTable
     */
    protected $PostComments;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PostComments',
        'app.Posts',
        'app.Clientusers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PostComments') ? [] : ['className' => PostCommentsTable::class];
        $this->PostComments = $this->getTableLocator()->get('PostComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PostComments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PostCommentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PostCommentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
