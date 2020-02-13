<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timesheet Entity
 *
 * @property int $id
 * @property string $job_number
 * @property int $employee_id
 * @property int $associated_id
 * @property bool|null $monday
 * @property bool|null $tuesday
 * @property bool|null $wednesday
 * @property bool|null $thursday
 * @property bool|null $friday
 * @property bool|null $saturday
 * @property bool|null $sunday
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenDate|null $for_date
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Associated $associated
 */
class Timesheet extends Entity
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
        'job_number' => true,
        'employee_id' => true,
        'associated_id' => true,
        'monday' => true,
        'tuesday' => true,
        'wednesday' => true,
        'thursday' => true,
        'friday' => true,
        'saturday' => true,
        'sunday' => true,
        'date_created' => true,
        'date_modified' => true,
        'for_date' => true,
        'employee' => true,
        'associated' => true,
    ];
}
