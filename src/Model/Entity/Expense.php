<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expense Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $item_name
 * @property string $item_number
 * @property string $taxable
 * @property float $item_cost
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $item_date
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenTime|null $date_added
 *
 * @property \App\Model\Entity\User $user
 */
class Expense extends Entity
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
        'item_name' => true,
        'item_number' => true,
        'taxable' => true,
        'item_cost' => true,
        'quantity' => true,
        'item_date' => true,
        'date_modified' => true,
        'date_added' => true,
        'user' => true
    ];
}
