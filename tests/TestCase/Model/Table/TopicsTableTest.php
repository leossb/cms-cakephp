<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TopicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TopicsTable Test Case
 */
class TopicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TopicsTable
     */
    public $Topics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Topics',
        'app.Courses',
        'app.Exams',
        'app.Lessons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Topics') ? [] : ['className' => TopicsTable::class];
        $this->Topics = TableRegistry::getTableLocator()->get('Topics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Topics);

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
