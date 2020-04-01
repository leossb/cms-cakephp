<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Topic Entity
 *
 * @property int $id
 * @property string $name
 * @property int $course_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\Exam[] $exams
 * @property \App\Model\Entity\Lesson[] $lessons
 */
class Topic extends Entity
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
        'name' => true,
        'course_id' => true,
        'created' => true,
        'modified' => true,
        'course' => true,
        'exams' => true,
        'lessons' => true,
    ];
}
