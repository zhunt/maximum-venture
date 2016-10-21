<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chain Entity.
 */
class Chain extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'schools' => true,
        'canonical_link' => true
    ];
}
