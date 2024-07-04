<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SiteSettingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SiteSettingsTable Test Case
 */
class SiteSettingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SiteSettingsTable
     */
    protected $SiteSettings;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.SiteSettings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SiteSettings') ? [] : ['className' => SiteSettingsTable::class];
        $this->SiteSettings = $this->getTableLocator()->get('SiteSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SiteSettings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SiteSettingsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
