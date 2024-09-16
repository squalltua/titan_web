<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientPayment Entity
 *
 * @property int $id
 * @property int $clientuser_id
 * @property string $payment_type
 * @property string $provider
 * @property string $account_number
 * @property \Cake\I18n\Date $expire_date
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Clientuser $clientuser
 */
class ClientPayment extends Entity
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
        'clientuser_id' => true,
        'payment_type' => true,
        'provider' => true,
        'account_number' => true,
        'expire_date' => true,
        'created' => true,
        'modified' => true,
        'clientuser' => true,
    ];
}
