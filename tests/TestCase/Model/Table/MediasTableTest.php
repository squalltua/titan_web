<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediasTable Test Case
 */
class MediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MediasTable
     */
    protected $Medias;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Medias',
        'app.MetaMedias',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Medias') ? [] : ['className' => MediasTable::class];
        $this->Medias = $this->getTableLocator()->get('Medias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Medias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MediasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
