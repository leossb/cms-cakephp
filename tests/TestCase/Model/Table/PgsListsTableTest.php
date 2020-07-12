<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PgsListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PgsListsTable Test Case
 */
class PgsListsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PgsListsTable
     */
    public $PgsLists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PgsLists',
        'app.Pgs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PgsLists') ? [] : ['className' => PgsListsTable::class];
        $this->PgsLists = TableRegistry::getTableLocator()->get('PgsLists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PgsLists);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
