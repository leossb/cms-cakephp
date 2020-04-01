<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoursesTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoursesTagsTable Test Case
 */
class CoursesTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoursesTagsTable
     */
    public $CoursesTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CoursesTags',
        'app.Courses',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CoursesTags') ? [] : ['className' => CoursesTagsTable::class];
        $this->CoursesTags = TableRegistry::getTableLocator()->get('CoursesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoursesTags);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
