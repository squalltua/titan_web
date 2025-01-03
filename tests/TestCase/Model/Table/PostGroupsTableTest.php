<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostGroupsTable Test Case
 */
class PostGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostGroupsTable
     */
    protected $PostGroups;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.PostGroups',
        'app.MetaPostGroups',
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
        $config = $this->getTableLocator()->exists('PostGroups') ? [] : ['className' => PostGroupsTable::class];
        $this->PostGroups = $this->getTableLocator()->get('PostGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PostGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategoriesAll method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::getCategoriesAll()
     */
    public function testGetCategoriesAll(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getTagsAll method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::getTagsAll()
     */
    public function testGetTagsAll(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getCategoriesList method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::getCategoriesList()
     */
    public function testGetCategoriesList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getTagsList method
     *
     * @return void
     * @uses \App\Model\Table\PostGroupsTable::getTagsList()
     */
    public function testGetTagsList(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
