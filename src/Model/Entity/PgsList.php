<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PgsList Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property string|null $image
 * @property int $pg_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Pg $pg
 */
class PgsList extends Entity
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
        'title' => true,
        'subtitle' => true,
        'description' => true,
        'image' => true,
        'pg_id' => true,
        'created' => true,
        'modified' => true,
        'pg' => true,
    ];
}
