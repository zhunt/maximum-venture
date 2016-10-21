<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * School Entity.
 */
class School extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'slug' => true,
        'seo_title' => true,
        'address' => true,
        'phone_1' => true,
        'phone_2' => true,
        'website_1_url' => true,
        'website_2_url' => true,
        'logo_id' => true,
        'description' => true,
        'chain_id' => true,
        'city_id' => true,
        'geo_latt' => true,
        'geo_long' => true,
        'chain' => true,
        'city' => true,
    ];
}
