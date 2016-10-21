<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $body
 * @property bool $flag_html
 * @property int $category_id
 * @property \App\Model\Entity\Category $category
 * @property bool $flag_featured
 * @property int $feature_image_id
 * @property \App\Model\Entity\ImageUpload $image_upload
 * @property string $feature_text
 * @property int $tag_count
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */

use Cake\Collection\Collection;

class Article extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'tag_string' => true,
        'id' => false,
        'flag_published' => true,
        //'confirm_captcha' => true
    ];

    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }


}





