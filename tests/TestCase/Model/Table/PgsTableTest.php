<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PgsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PgsTable Test Case
 */
class PgsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PgsTable
     */
    public $Pgs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pgs',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pgs') ? [] : ['className' => PgsTable::class];
        $this->Pgs = TableRegistry::getTableLocator()->get('Pgs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pgs);

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
