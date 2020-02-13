<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property string $number
 * @property \Cake\I18n\FrozenDate|null $start_date
 * @property string $location
 * @property int|null $budget
 * @property string|null $name
 * @property \Cake\I18n\FrozenDate|null $end_date
 */
class Job extends Entity
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
        'number' => true,
        'start_date' => true,
        'location' => true,
        'budget' => true,
        'name' => true,
        'end_date' => true
    ];
}
