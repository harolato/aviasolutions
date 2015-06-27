<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CompaniesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CompaniesController Test Case
 */
class CompaniesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.companies'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/companies');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/companies/view');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
