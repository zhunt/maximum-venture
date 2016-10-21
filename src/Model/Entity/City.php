<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity.
 */
class City extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'slug' => true,
        'name' => true,
        'city_text' => true,
        'province_id' => true,
        'country_id' => true,
        'flag_featured' => true,
        'province' => true,
        'country' => true,
        'schools' => true,
    ];
}
