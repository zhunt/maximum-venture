<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContentBlock Entity.
 */
class ContentBlock extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'content' => true,
        'flag_html' => true,
    ];
}
