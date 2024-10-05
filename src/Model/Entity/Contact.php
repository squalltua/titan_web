<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string|null $position
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Contact extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'customer_id' => true,
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'phone' => true,
        'email' => true,
        'position' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
    ];
}
