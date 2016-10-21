<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Province Entity.
 */
class Province extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'country_id' => true,
        'country' => true,
        'cities' => true,
    ];
}
