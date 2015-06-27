<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity.
 */
class Company extends Entity
{

    /**
     * Klase sugeneruota su Cake Bake
     *
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'address' => true,
        'email' => true,
        'phone_no' => true,
    ];
}
