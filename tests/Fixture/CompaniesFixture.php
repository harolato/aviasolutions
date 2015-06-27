<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompaniesFixture
 *
 */
class CompaniesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'phone_no' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 2,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 3,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 4,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 5,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 6,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 7,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 8,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 9,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
        [
            'id' => 10,
            'name' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor '
        ],
    ];
}
