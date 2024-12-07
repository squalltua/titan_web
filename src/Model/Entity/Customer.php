<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $title
 * @property string $phone
 * @property string $email
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string|null $postcode
 * @property string|null $source
 * @property string|null $contact_type
 * @property string|null $avatar
 * @property \Cake\I18n\Date|null $date_of_birth
 * @property string $type
 * @property string|null $service_type
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\CustomerNote[] $customer_notes
 * @property \App\Model\Entity\MetaCustomer[] $meta_customers
 * @property \App\Model\Entity\PurchaseOrder[] $purchase_orders
 */
class Customer extends Entity
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
        'title' => true,
        'phone' => true,
        'email' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'city' => true,
        'province' => true,
        'country' => true,
        'postcode' => true,
        'source' => true,
        'contact_type' => true,
        'avatar' => true,
        'date_of_birth' => true,
        'type' => true,
        'service_type' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'contacts' => true,
        'customer_notes' => true,
        'meta_customers' => true,
        'purchase_orders' => true,
    ];
}
