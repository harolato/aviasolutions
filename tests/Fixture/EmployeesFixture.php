<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 *
 */
class EmployeesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'surname' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'company_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'employment_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'company_id' => ['type' => 'index', 'columns' => ['company_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_companies_employees' => ['type' => 'foreign', 'columns' => ['company_id'], 'references' => ['companies', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 1,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 2,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 2,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 3,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 3,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 4,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 4,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 5,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 5,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 6,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 6,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 7,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 7,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 8,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 8,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 9,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 9,
            'employment_date' => '2015-06-27'
        ],
        [
            'id' => 10,
            'name' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'company_id' => 10,
            'employment_date' => '2015-06-27'
        ],
    ];
}
