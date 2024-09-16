<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientAddress Entity
 *
 * @property int $id
 * @property int $clientuser_id
 * @property string|null $address_line1
 * @property string|null $address_line2
 * @property string|null $city
 * @property string|null $province
 * @property string|null $postcode
 * @property string|null $country
 * @property string|null $telephone_number
 * @property string|null $mobile_number
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Clientuser $clientuser
 */
class ClientAddress extends Entity
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
        'address_line1' => true,
        'address_line2' => true,
        'city' => true,
        'province' => true,
        'postcode' => true,
        'country' => true,
        'telephone_number' => true,
        'mobile_number' => true,
        'created' => true,
        'modified' => true,
        'clientuser' => true,
    ];
}
