<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clientuser Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $email
 * @property string $phone_number
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\ClientAddress[] $client_addresses
 * @property \App\Model\Entity\ClientPayment[] $client_payments
 */
class Clientuser extends Entity
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
        'username' => true,
        'password' => true,
        'full_name' => true,
        'email' => true,
        'phone_number' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'client_addresses' => true,
        'client_payments' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];
}
