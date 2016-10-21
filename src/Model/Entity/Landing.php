<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Landing Entity.
 */
class Landing extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'page_name' => true,
        'seo_title' => true,
        'seo_desc' => true,
        'page_type_id' => true,
        'block_1_title' => true,
        'block_1_content' => true,
        'block_2_title' => true,
        'block_2_content' => true,
        'block_3_title' => true,
        'block_3_content' => true,
        'block_4_title' => true,
        'block_4_content' => true,
        'block_5_title' => true,
        'block_5_content' => true,
        'page_type' => true,
    ];
}
