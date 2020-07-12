<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pg Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property string $slug
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string|null $body
 * @property bool|null $published
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Pg $parent_pg
 * @property \App\Model\Entity\Pg[] $child_pgs
 */
class Pg extends Entity
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
        'user_id' => true,
        'parent_id' => true,
        'slug' => true,
        'lft' => true,
        'rght' => true,
        'name' => true,
        'body' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'parent_pg' => true,
        'child_pgs' => true,
    ];
}
